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

class slideModel extends Model
{
    protected $table = 'cmf_slide_item';
    protected $type = [
        'more' => 'array',
    ];
    public function getSlides(){
        $list = $this->where(['status'=>1,'slide_id'=>1])->order('list_order')->select();

        return $list;
    }


}