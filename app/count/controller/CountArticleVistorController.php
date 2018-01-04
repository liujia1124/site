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
namespace app\count\controller;

use cmf\controller\AdminBaseController;
use app\count\model\VistorLogModel;
use think\Db;

class CountArticleVistorController extends AdminBaseController
{
    public function index()
    {
        $pageNum = $this->request->param('page_num');
        $startTime = $this->request->param('start_time');
        $endTime   = $this->request->param('end_time');
        //回显
        if($startTime){
            $this->assign('sTime', $startTime);
        }
        if($endTime){
            $this->assign('eTime', $endTime);
        }


        $db   = new VistorLogModel();
        $list = $db->showVistorsBypage( $startTime, $endTime, $pageNum);

        $this->assign('page', $list->render());

        $this->assign('list', $list);

        $this->assign('type', 'all');

        return $this->fetch();

    }


    public function real()
    {
        $pageNum = $this->request->param('page_num');
        $startTime = $this->request->param('start_time');
        $endTime   = $this->request->param('end_time');
        //回显
        if($startTime){
            $this->assign('sTime', $startTime);
        }
        if($endTime){
            $this->assign('eTime', $endTime);
        }


        $db   = new VistorLogModel();
        $list = $db->showRealVistorsBypage( $startTime, $endTime, $pageNum);

        $this->assign('page', $list->render());

        $this->assign('list', $list);

        $this->assign('type', 'real');

        return $this->fetch();

    }

}
