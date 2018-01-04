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

class CategoryPostModel extends Model
{
    protected $table = 'cmf_portal_category_post';
    public function addCategoryPost($categoryId, $articleId){

        $data['category_id'] = $categoryId;
        $data['post_id']      = $articleId;
        $data['list_order']  = 10000;
        $data['status']       = 1;

        return $this->save($data);
    }


}