<?php

namespace app\portal\model;

use app\admin\model\RouteModel;
use think\Model;
use think\Db;

class PortalSpiderModel extends Model
{
    protected $table = 'spider_content';
    protected $type = [
        'more' => 'array',
    ];


    public function getArticleList()
    {
        return $this->order('id desc')->paginate(50);
    }

    public function getArticle($id)
    {
        return $this->where('id', $id)->find();
    }



    public function saveEdit($data)
    {
        $id = $data['id'];
        $title = $data['title'];
        $content = $data['content'];

        return $this->save(['title'=>$title,'content'=>$content],['id'=>$id]);

    }

    public function deleteArticle($id)
    {
        return $this->where('id',$id)->delete();

    }



}
