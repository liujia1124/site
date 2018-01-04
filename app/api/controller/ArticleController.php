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
namespace app\api\controller;

use app\portal\model\CategoryPostModel;
use app\portal\model\PortalCategoryModel;
use app\portal\service\PostService;
use app\portal\model\PortalPostModel;
use think\Db;
use cmf\controller\ApiBaseController;

class ArticleController extends ApiBaseController
{
    //上传文章
    public function addArticle()
    {
        $data = ApiBaseController::$data;

        if(empty($data['title'])){
            exit('title is need');
        }
        if(empty($data['content'])){
            exit('content is need');
        }
        if(empty($data['category'])){
            exit('category is need');
        }
        if(empty($data['userId'])){
            exit('userId is need');
        }

        $title     = $data['title'];
        $keywords  = empty($data['keywords'])? '': $data['keywords'];
        $excerpt   = empty($data['excerpt'])? '': $data['excerpt'];
        $content   = $data['content'];
        $thumbnail = empty($data['thumbnail'])? '': $data['thumbnail'];
        $more      = ['thumbnail'=>$thumbnail, 'template'=>''];
        $time = time();
        $add = [];
        $add['post_title']      = $title;
        $add['post_keywords']   = $keywords;
        $add['post_excerpt']    = $excerpt;
        $add['post_content']    = $content;
        $add['more']             = json_encode($more);
        $add['user_id']          = $data['userId'];
        $add['spider_id']        = $data['spiderId'];
        $add['spider_text_id']  = $data['spiderTextId'];
        $add['create_time']     = $time;
        $add['post_source']     = $data['url'];

        $postModel     = new PortalPostModel();
        $postId = $postModel->addArticle($add);
        if(!$postId){
           exit('fail');
        }
        $categoryModel = new CategoryPostModel();
        $categoryModel->addCategoryPost($data['category'], $postId);

        exit('success');

    }
    //检查文章是否存在
    public function checkExist(){
        $data = ApiBaseController::$data;
        $spiderId = $data['spiderId'];
        $textId   = $data['textId'];
        if(empty($spiderId)||empty($textId)){
            exit('error');
        }
        $postModel     = new PortalPostModel();
        $postId = $postModel->getArticleId($spiderId, $textId);
        if($postId){
            exit('yes');
        }
        exit('no');
    }
    //检查文章并修改,使文章否符合要求
    public function checkArticle(){

    }
    //发布文章
    public function publish(){

    }



}
