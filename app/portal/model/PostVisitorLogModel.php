<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\portal\model;

use think\Model;

class PostVisitorLogModel extends Model
{
    protected $table = "post_vistor_log";

    public function addPostVisitorLog($userId, $articleId, $host){

        $postId     = $articleId;
        $fromUrl    = empty($_SERVER['HTTP_REFERER'])?'':$_SERVER['HTTP_REFERER'];
        $realIp     = $this->getUserIp();
        $agentIp    = $_SERVER['REMOTE_ADDR'];
        $isMobile         = $this->isMobile();
        $createTime = date('Y-m-d H:i:s',time());
        $arr = [];
        $arr['user_id']      = $userId;
        $arr['post_id']      = $postId;
        $arr['from_url']     = $fromUrl;
        $arr['real_ip']      = $realIp;
        $arr['agent_ip']     = $agentIp;
        $arr['is_mobile']    = $isMobile;
        $arr['create_time'] = $createTime;

        $rs = $this->save($arr);
        if($rs){
           return true;
        }
        return false;
    }

    public function isMobile()
    {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
        {
            return true;
        }
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA']))
        {
            // 找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT']))
        {
            $clientkeywords = array ('nokia',
                'sony',
                'ericsson',
                'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap',
                'mobile'
            );
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            {
                return true;
            }
        }
        // 协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT']))
        {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
            {
                return true;
            }
        }
        return false;
    }
    //获取真实ip
    public function getUserIp() {
        $onlineip='';
        if(getenv('HTTP_CLIENT_IP')&&strcasecmp(getenv('HTTP_CLIENT_IP'),'unknown')){
            $onlineip=getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR')&&strcasecmp(getenv('HTTP_X_FORWARDED_FOR'),'unknown')){
            $onlineip=getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR')&&strcasecmp(getenv('REMOTE_ADDR'),'unknown')){
            $onlineip=getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR'])&&$_SERVER['REMOTE_ADDR']&&strcasecmp($_SERVER['REMOTE_ADDR'],'unknown')){
            $onlineip=$_SERVER['REMOTE_ADDR'];
        }
        return $onlineip;
    }
    //按作者某段时间统计访客数量
    public function count($userId, $startTime='', $endTime=''){

        if(empty($startTime)){
            $startTime = date('Y-m', time());
        }

        $where['user_id'] = $userId;
        $where['create_time']=['>=',$startTime];
        if($endTime){
            $where['create_time']=['<',$endTime];
        }

        $rs = $this->where($where)->field('from_url,count(*) as num ')->group('from_url')->select()->toArray();

        $total = 0;
        foreach($rs as $v){
            $total += $v['num'];
        }
        $rs[] = ['from_url'=>'<span style="font-weight: 700;font-size: 18px" >总计</span>', 'num'=>"<span style='font-weight: 700;font-size: 18px'>$total</span>"];

        return $rs;
    }

    public function checkExist($postId){
        $realIp     = $this->getUserIp();
        $today      = date('Y-m-d', time());
        $sql = "select * from post_vistor_log where post_id=$postId and real_ip='$realIp' and create_time like '$today%'";
        $rs  = $this->query($sql);
        if($rs){
            return true;
        }

        return false;
    }

}