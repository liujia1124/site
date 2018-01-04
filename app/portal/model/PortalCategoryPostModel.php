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
class PortalCategoryPostModel extends Model
{

   public function getPostIds($catId=0)
   {

       if ($catId == 0) {
           return [];
       }

       $children = $this->table('cmf_portal_category')->where(['parent_id'=>$catId])->select()->toArray();
       $childIdArr = [];
       foreach($children as $v){
           $childIdArr[] = $v['id'];
       }
       if(empty($childIdArr)){
           $rs = $this->where(['category_id' => $catId])

               ->column("post_id");
       }else{
           $rs = $this->where(['category_id' =>[ 'in',$childIdArr] ])

               ->column("post_id");
       }

        return $rs;
   }


}