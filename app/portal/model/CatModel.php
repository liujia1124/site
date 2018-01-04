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

class CatModel extends Model
{
    protected $table = 'cmf_portal_category';
    public function getCats(){
        $list = $this->field('id,name')->where(['status'=>1])->select();

        return $list;
    }

    /**
     * 获取一级分类
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getFirstCats(){
        $list = $this->field('id,name')->where(['status'=>1,'parent_id'=>0])->select()->toArray();

        return $list;
    }

    public function getSecondCatIds(){
        $list = $this->field('id,name')->where(['status'=>1,'path'=>['like','%-%-%']])->select();

        return $list;
    }

    public function getChildren($parentId){
        $list = $this->field('id, parent_id ,name')->where(['status'=>1,'parent_id'=>$parentId])->select();

        return $list;
    }


}