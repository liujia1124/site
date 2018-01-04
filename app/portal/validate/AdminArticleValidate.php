<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace app\portal\validate;

use think\Validate;

class AdminArticleValidate extends Validate
{
    protected $rule = [
        'categories' => 'require',
        'post_title' => 'require',
        'post_keywords' => 'require',
        'more.thumbnail' => 'require',
        'post_title' => 'length:2,40',
    ];
    protected $message = [
        'categories.require' => '请指定文章分类！',
        'post_title.require' => '文章标题不能为空！',
        'post_keywords.require' => '关键词不能为空！',
        'more.thumbnail.require' => '略缩图必须上传！',
        'post_title.length'      => '标题长度必须少于40个字',
    ];

    protected $scene = [
//        'add'  => ['user_login,user_pass,user_email'],
//        'edit' => ['user_login,user_email'],

    ];
}