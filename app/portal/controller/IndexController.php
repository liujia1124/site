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

use app\portal\model\SlideModel;
use cmf\controller\HomeBaseController;
use app\portal\model\CatModel;
use app\portal\model\ContentModel;
use app\admin\model\LinkModel;

class IndexController extends HomeBaseController
{
    public function index()
    {
        $linkModel = new LinkModel();
        $links     = $linkModel->select();
        $this->assign('links', $links);

        $contentModel = new ContentModel;
        $titleList  = $contentModel->getTitles();
        $topList    = $contentModel->getTops();

        $catModel       = new CatModel;
        $catSecondList  = $catModel->getSecondCatIds();
        $this->assign('catSecondList', $catSecondList);
        foreach($titleList as $k=>$v){
            $more                      = $v['more'];
            $picture                   = $more['thumbnail'];
            $titleList[$k]['picture'] = $picture;
        }
        foreach($topList as $k=>$v){
            $more                    = $v['more'];
            $picture                 = $more['thumbnail'];
            $topList[$k]['picture'] = $picture;
        }

        $this->assign('titleList', $titleList);
        $this->assign('topList', $topList);


        $slideModel = new SlideModel();
        $slideList = $slideModel->getSlides();
        $this->assign('slideList', $slideList);

        return $this->fetch(':index');

    }
    public function getSecondCat(){

        $linkModel = new LinkModel();
        $links     = $linkModel->select();
        $this->assign('links', $links);
        $secondCategory = $this->request->param('id');
        $category = $this->request->param('cid');
        if(empty($category)){
            return false;
        }

        $model = new CatModel();
        $secondCat = $model->getChildren($category);
        $this->assign('secondCat',$secondCat);

        $contentModel = new ContentModel;
        if($secondCategory){
            $titleList  = $contentModel->getcatTitleByPage($secondCategory);
        }else{
            $titleList  = $contentModel->getTitles($category);
        }

        foreach($titleList as $k=>$v){
            $more = $v['more'];
            $picture = $more['thumbnail'];
            $titleList[$k]['picture'] = $picture ? $picture : 'empty.jpg';
        }

        $topList    = $contentModel->getTops();
        foreach($topList as $k=>$v){
            $more = $v['more'];
            $picture = $more['thumbnail'];
            $topList[$k]['picture'] = $picture ? $picture : 'empty1.jpg';
        }

        $this->assign('category', $category);
        $this->assign('secondCategory', $secondCategory);
        $this->assign('titleList', $titleList);
        $this->assign('topList', $topList);


        return $this->fetch(':secondCat');
    }
}
