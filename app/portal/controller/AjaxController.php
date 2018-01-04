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
namespace app\portal\controller;

use cmf\controller\HomeBaseController;
use app\portal\model\PortalCategoryPostModel;
use app\portal\model\ContentModel;
use think\Db;

class AjaxController extends HomeBaseController
{
    public function getTitles(){
        $catId    = input('catId');
        $pageNum  = input('pageNum');
        $pageSize = input('pageSize');

        if($catId == 0){
            $PostModel = new  ContentModel();
            $maps  = $PostModel->getAllByPage($pageNum,$pageSize);
            $newMaps = [];
            foreach($maps as $k=>$v){
                $more = $v['more'];
                $picture = $more['thumbnail'];
                $newMaps[] =[
                    'post_id'      => $v['id'],
                    'post_title'  => $v['post_title'],
                    'published_time' => date('Y-m-d H:i',$v['published_time']),
                    'picture'      => $picture
                ];
            }
            return $newMaps;

        }

        $categoryPostModel = new  PortalCategoryPostModel;
        $postIds  = $categoryPostModel->getPostIds($catId,$pageNum,$pageSize);
        $PostModel = new  ContentModel();
        $maps  = $PostModel->getMaps($postIds, $pageNum, $pageSize);

        $newMaps = [];

        foreach($maps as $k=>$v){
            $more = $v['more'];
            $picture = $more['thumbnail'];
            if(empty($picture)){
                $picture = 'empty.jpg';
            }
            $newMaps[] =[
                'post_id'      => $v['id'],
                'post_title'  => $v['post_title'],
                'published_time' => date('Y-m-d H:i',$v['published_time']),
                'picture'      => $picture
            ];

        }

        return $newMaps;
    }

}
