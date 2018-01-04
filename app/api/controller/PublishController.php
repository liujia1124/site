<?php
namespace app\api\controller;

use app\api\model\CmfPortalPostModel;
use app\file\controller\FanJianConvertController;
use think\console\command\make\Controller;

class PublishController extends Controller
{

    public function index()
    {
        $id = input('id');
        $model = new CmfPortalPostModel();
        $rs = $model->getPost($id);
        var_dump($rs);exit;
        return   $rs;
    }

    /**
     * 将文字转化为繁体
     * @param $postId
     */
    public function format(){
        $postId=input('id');
        $model   = new CmfPortalPostModel();
        $rs      = $model->getPost($postId);
        $data    = [];
        $id      = $rs['id'];
        $host = $rs['post_source'];
        $host = explode('/', $host );

        if(empty($host[2])){
            return false;
        }
        $host = $host[0].'//'.$host[2];

        $data['post_title']    = $this->tran($rs['post_title']);
        $data['post_content']  = $this->tranContent($rs['post_content']);
        $data['post_keywords'] = $this->tran($rs['post_keywords']);
        $data['post_excerpt']  = $this->tran($rs['post_excerpt']);
        $data['more']           = $this->formatMore($host, $rs['more']);
        $data['post_content']        = $this->formatContent($host, $data['post_content']);
        $data['spider_status'] = 1;

        return $model->savePost($id, $data);
    }

    public function formatMore($host, $json){
        $arr = json_decode($json, true);
        if(empty($arr['thumbnail'])){
            return $json;
        }
        $url            = $arr['thumbnail'];

        $path =  $this->loadPicture($host, $url);
        if($path){
            $more = [];
            $more['thumbnail'] = $path;
            $more['template']  = '';
            return json_encode($more);
        }

        return false;

    }

    /**
     * 文章远程图片转换为本地
     * @param $host
     * @param $content
     * @return bool
     */
    public function formatContent($host, $content){
        include_once ROOT_PATH.'public/simplehtmldom/simple_html_dom.php';
        $content = htmlspecialchars_decode($content);
        $html = str_get_html($content);
        foreach($html->find('img') as $v){
            $url = $v->src;
            if(strpos($url, $_SERVER['HTTP_HOST'])){
                continue;
            }
            $path = $this->loadPicture($host, $url, 'img');
            if($path){
                $v->outertext = "<img src='http://{$_SERVER['HTTP_HOST']}/upload/{$path}'>";
            }
        }
        return htmlspecialchars($html);
    }

    /**
     * 下载图片
     * @param $postId
     */
    public function loadPicture($host, $url, $path=''){
        if(!is_dir(UPLOAD_ROOT.'third')){
            mkdir(UPLOAD_ROOT.'third');
        }
        if(empty($path)){
            $path = 'third/'.time().rand(100,999).'.jpg';
        }else{
            if(!is_dir(UPLOAD_ROOT.'third/'.$path)){
                mkdir(UPLOAD_ROOT.'third/'.$path);
            }
            $path = 'third/'.$path.'/'.time().rand(100,999).'.jpg';
        }
        $arr['url']    = $url;
        $arr['header'] = [
            'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            'Accept-Language:zh-CN,zh;q=0.8',
            'Connection:keep-alive',
            'Upgrade-Insecure-Requests:1',
            'User-Agent:Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.79 Safari/537.36',
            'Referer'.$host
        ];
        $pic = $this->send($arr);

        if(file_put_contents(UPLOAD_ROOT.$path, $pic)){
            return $path;
        };

        return false;
    }

    /**
     * 发布文章
     * @param $postId
     */
    public function publish(){
        $id = input('id');
        $time = input('time')?input('time'):time();

        $model   = new CmfPortalPostModel();
        $rs      = $model->publish($id, $time);

        if($rs){
            return 'yes';
        }

        return 'no';
    }

    //简体繁体转化
    public function tran($content){
        return FanJianConvertController::simple2tradition($content);
    }
    //过滤字符后简体繁体转化
    public function tranContent($content){
        $content = htmlspecialchars_decode($content);
        $content =  preg_replace_callback(

            '/>[^<]+<\//U',
            function ($matches) {
                return FanJianConvertController::simple2tradition($matches[0]);
            },
            $content
        );
        $content = htmlspecialchars($content);
        return $content;
    }

    public function send($arr){

        $url = empty($arr['url']) ? 0 : $arr['url'];
        $header =  $arr['header'];
        $data = empty($arr['data']) ? '' : $arr['data'];
        $post = empty($arr['post']) ? 0 : 1;
        $debug = empty($arr['debug']) ? 0 : 1;
        $showHeader = empty($arr['showHeader']) ? 0 : 1;
        $cookie_jar_index = ROOT_PATH . 'cookies/sina.txt';
        $ch = curl_init();
        if (!$url) {
            echo "请输入url参数";
            return false;
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        //	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar_index);
        //	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar_index);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //是否post
        if ($post) {
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        //发送头消息
        if (!empty($header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        //post内容
        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        //是否输出到页面
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //是否显示头消息
        if ($showHeader) {
            curl_setopt($ch, CURLOPT_HEADER, true);
        }
        // 是否开启调试
        if ($debug) {
            curl_setopt($ch, CURLOPT_VERBOSE, true);
        }
        $rs = curl_exec($ch);
        //是否开启调试
        if($debug){
            var_dump(curl_getinfo($ch));
        }
        curl_close($ch);
        return $rs;

    }

}
