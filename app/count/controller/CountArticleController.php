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
use app\count\model\PortalPostModel;
use think\Db;

class CountArticleController extends AdminBaseController
{
    public function index()
    {
        $startTime = $this->request->param('start_time');
        $endTime   = $this->request->param('end_time');

        $startTime = empty($startTime)?date("Y-m-d"):$startTime;
        $endTime   = empty($endTime)?date("Y-m-d",strtotime("+1 day")):$endTime;

        $startTime   = strtotime($startTime);
        $endTime     = strtotime($endTime);

        $db   = new PortalPostModel();
        $list = $db->countArticle($startTime,$endTime);

        $this->assign('list', $list);

        return $this->fetch();

    }


}
