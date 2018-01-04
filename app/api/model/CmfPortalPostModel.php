<?php
namespace app\api\model;

use think\Model;

class CmfPortalPostModel extends Model
{
    protected $table = 'cmf_portal_post';

    public function getPost($id){
        return $this->where(['id'=>$id])->find()->toArray();
    }

    public function savePost($id,$data){
        return $this->where(['id'=>$id])->update($data);
    }

    public function publish($id, $time){
        $data['published_time'] = $time;
        $rs = $this->where(['id'=>$id])->find();
        if(!$rs['spider_status']){
            return false;
        }

        return $this->where(['id'=>$id])->update($data);
    }


}
