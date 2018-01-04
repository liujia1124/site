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

class ContentModel extends Model
{
    protected $table = 'cmf_portal_post';
    protected $type = [
        'more' => 'array',
    ];
    public function getTitles($cid=0){
        if($cid ==0){
            $list = $this->field('id,post_title,published_time,more')->where([ 'post_status'=>1,'delete_time'=>0, 'published_time'=>['>' ,0] ])->order('published_time desc')->limit(0,20)->select();
        }else {
            $cats = $this->table('cmf_portal_category')->field('id')->where(['parent_id' => $cid, 'status' => 1, 'delete_time' => 0 ])->select()->toArray();

            $catArr = [];
            foreach ($cats as $v) {
                $catArr[] = $v['id'];
            }

            $postIds = $this->table('cmf_portal_category_post')->field('post_id')->where('category_id', 'in', $catArr)->select()->toArray();
            $postArr = [];
            foreach ($postIds as $v) {
                $postArr[] = $v['post_id'];
            }
            $list = $this->field('id,post_title,published_time,more')->where(['post_status'=>1, 'delete_time'=>0,'id'=>['in',$postArr],  'published_time'=>['>' ,0]])->order('published_time desc')->limit(0, 20)->select();
        }

        return $list;
    }

    public function getTops(){
        $list = $this->field('id,post_title,published_time,more')->where(['post_status'=>1,'delete_time'=>0,'published_time'=>['>' ,0]])->order('post_hits desc')->limit(0,5)->select();

        return $list;
    }

    public function getPost($id){
        return  $this->where(['id'=>$id,'post_status'=>1,'delete_time'=>0, 'published_time'=>['>' ,0]])->find();
    }

    public function getMaps($arr, $pageNum, $pageSize=20){
        $start = ($pageNum - 1) * $pageSize;
        $length = $pageSize;
        $rs = $this->field('id,published_time,post_title,more')
            ->where(['post_status'=>1,'delete_time'=>0 ,'published_time'=>['>' ,0] ])
            ->where('id','in',$arr)
            ->order('published_time desc')
            ->limit($start, $length)
            ->select();

        return $rs;
    }

    /**
     * 获取所有分页文章
     * @return array|false|\PDOStatement|string|Model
     */
    public function getAllByPage($pageNum, $pageSize){

        $start = ($pageNum - 1) * $pageSize;
        $length = $pageSize;;

        return  $this->where(['post_status'=>1,'delete_time'=>0, 'published_time'=>['>' ,0] ])->order('published_time desc')->limit($start,$length)->select()->toArray();
    }

    public function getcatTitleByPage( $catId, $pageNum = 1, $pageSize = 20){
        $start = ($pageNum - 1) * $pageSize;
        $length = $pageSize;;

        $postIds = $this->table('cmf_portal_category_post')->field('post_id')->where(['category_id'=>$catId ])->select()->toArray();
        $postArr = [];
        foreach ($postIds as $v) {
            $postArr[] = $v['post_id'];
        }
        $list = $this->field('id,post_title,published_time,more')->where(['post_status'=>1, 'delete_time'=>0,'id'=>['in',$postArr],  'published_time'=>['>' ,0]])->order('published_time desc')->limit(0, 20)->select()->toArray();
        return $list;
    }

}