<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +---------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace cmf\controller;


use think\Controller;

class ApiBaseController extends Controller
{
    public static $data;

    private $signList=[
        'http://www.enjoyhere.net',
        'http://127.0.0.1'
    ];
    public function _initialize()
    {

        parent::_initialize();
        $checkAuth = $this->checkAuth();
        if(!$checkAuth){
            exit('auth deny');
        };

    }

    private function checkAuth(){
        $api = $this->request->param('api');
        $api = urldecode($api);
        $api = json_decode($api, true);
        $header = $api['header'];
        if(empty($header['time'])&&empty($header['sign'])&&empty($header['token'])){
            return false;
        }
        $time = $header['time'];
        if(time()-$time>20){
            return false;
        }

        $sign = $header['sign'];
        if(!in_array($sign, $this->signList)){
            return false;
        }

        $token = $header['token'];
        if($token !== md5($time.$sign)){
            return false;
        }
        self::$data = $api['data'];
        return true;

    }

}