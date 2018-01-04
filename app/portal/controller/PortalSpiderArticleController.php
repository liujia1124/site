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
namespace app\portal\controller;

use app\file\controller\FanJianConvert;
use cmf\controller\AdminBaseController;
use app\portal\model\PortalSpiderModel;

use think\Db;
use app\admin\model\ThemeModel;
use app\file\controller\FanJianConvertController;

class PortalSpiderArticleController extends AdminBaseController
{
    /**
     * 文章列表
     */
    public function index()
    {

        $portalSpiderModel = new PortalSpiderModel();

        $list  = $portalSpiderModel->getArticleList();


        $this->assign('list', $list);
        $this->assign('page', $list->render(0));
        return $this->fetch();
    }


    /**
     * 编辑文章
     */
    public function edit()
    {
        $id = $this->request->param('id', 0, 'intval');

        $portalSpiderModel = new PortalSpiderModel();
        $article = $portalSpiderModel->getArticle($id);
        $article['content'] = htmlspecialchars_decode($article['content']);
        $this->assign('post', $article);

        return $this->fetch();
    }

    /**
     * 编辑文章提交
     */
    public function editPost()
    {

        if ($this->request->isPost()) {
            $data   = $this->request->param();
            $post   = $data['post'];

            $portalSpiderModel = new PortalSpiderModel();

            $portalSpiderModel ->saveEdit($post);

            $this->success('保存成功!');

        }
    }

    /**
     * 文章删除

     */
    public function delete()
    {
        $param  = $this->request->param();
        $id = $param['id'];
        $portalSpiderModel = new PortalSpiderModel();
        $portalSpiderModel->deleteArticle($id);
        $this->success("删除成功！",'portal/portalSpiderArticle/index','',1);

    }



}
