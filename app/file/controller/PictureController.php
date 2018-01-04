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
namespace app\file\controller;

use cmf\controller\HomeBaseController;

class PictureController extends HomeBaseController
{
    public function changePicture()
    {
        $data  = input('data');
        $data  = base64_decode($data);
        $name  = input('name');
        $time  = input('time');
        $token = input('token');

        $authCheck = $this->checkAuth($name, $time, $token);
        if(!$authCheck){
            return false;
            exit;
        }

        $rs = $this->uploadPicture($data, $name);

        if($rs){
            return 'success';
            exit;
        }

        return false;
        exit;

    }

    public function uploadPicture($data, $name){

        $path = CMF_ROOT.'public/upload/picture/'.$name;
        if(empty($data)){
            return false;
        }
        return file_put_contents($path, $data);

    }

    public function checkAuth(){
        $name  = input('name');
        $time  = input('time');
        $token = input('token');

        if(md5($name.$time) === $token){
            return true;
        }

        return false;
    }

}
