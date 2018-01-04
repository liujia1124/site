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

use cmf\controller\ApiBaseController;
use cmf\controller\HomeBaseController;

class PictureController extends ApiBaseController
{
    public function upFile()
    {
        $data  = input('data');
        $file  =  base64_decode($data['file']);
        $name  = base64_decode($data['name']);

        $rs = $this->uploadPicture($data, $name);

        if($rs){
            return $rs;
        }

        return false;

    }

    public function saveFile($data, $name){

        $path = CMF_ROOT.'public/upload/picture/'.$name;
        if(empty($data)){
            return false;
        }
        if(file_put_contents($path, $data)){
            return 'public/upload/picture/'.$name;
        }

        return false;
    }


}
