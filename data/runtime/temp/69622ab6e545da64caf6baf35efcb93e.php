<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:41:"themes/simpleboot3/portal\\secondCat.html";i:1514340535;s:39:"themes/simpleboot3/public\googleAd.html";i:1512106702;s:40:"themes/simpleboot3/public\headerTop.html";i:1513231504;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo (isset($site_info['site_name']) && ($site_info['site_name'] !== '')?$site_info['site_name']:''); ?></title>
    <meta name="keywords" content="<?php echo (isset($site_info['site_seo_keywords']) && ($site_info['site_seo_keywords'] !== '')?$site_info['site_seo_keywords']:''); ?>"/>
    <meta name="description" content="<?php echo (isset($site_info['site_seo_description']) && ($site_info['site_seo_description'] !== '')?$site_info['site_seo_description']:''); ?>">
    <link href="__TMPL__/public/assets/css/siteIndex.css" rel="stylesheet">
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script src="/static/js/jquery.js"></script>
    

</head>

<body class="body-index">

<div class="header-top-box">

    <div class="header-top-cat">
        <div class="header-top-cat-every">
            <a href="<?php echo url('portal/index/index'); ?>"><b>首頁</b></a>
        </div>
        <?php if(is_array($catList) || $catList instanceof \think\Collection || $catList instanceof \think\Paginator): $i = 0; $__LIST__ = $catList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['id'] != 9): ?>
                <div class="header-top-cat-every">
                    <a href="<?php echo url('portal/index/getSecondCat',['cid'=>$vo['id']]); ?>"><?php echo $vo['name']; ?></a>
                </div>
            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
        <div class="clear"></div>
    </div>

    <div class="header-top-right ">

    </div>
    <div class="div-clear"></div>
</div>

<div class="container">
    <div class="middle">
        <div class="home">
            <a href="<?php echo url('portal/index/index'); ?>"><?php echo (isset($site_info['site_name']) && ($site_info['site_name'] !== '')?$site_info['site_name']:''); ?></a>
        </div>
        <div class="cat-box">
            <div class="every-cat" id = "cat-0"  >
                <a href="<?php echo url('portal/index/index'); ?>">最新</a>
            </div>
            <?php if(is_array($catList) || $catList instanceof \think\Collection || $catList instanceof \think\Paginator): $i = 0; $__LIST__ = $catList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <div class="every-cat" <?php if($category == $vo['id']): ?>style="background:#ed4040;"<?php endif; ?>  >
                    <a href="<?php echo url('portal/index/getSecondCat',['cid'=>$vo['id']]); ?>"><?php echo $vo['name']; ?></a>
                </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>



        <div class="title-box ">

            <div class="secondCat">
                <div class="secondCat-every"  >
                    <a href="<?php echo url('portal/index/getSecondCat',['cid'=>$category]); ?>">
                        <span <?php if($secondCategory == 0): ?>style="color:#ed4040;"<?php endif; ?>>
                        全部
                        </span>
                    </a>
                </div>
                <?php if(is_array($secondCat) || $secondCat instanceof \think\Collection || $secondCat instanceof \think\Paginator): $i = 0; $__LIST__ = $secondCat;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <div class="secondCat-every">
                        <a href="<?php echo url('portal/index/getSecondCat',['id'=>$vo['id'], 'cid'=>$vo['parent_id'] ]); ?>">
                            <span <?php if($secondCategory == $vo['id']): ?>style="color:#ed4040;"<?php endif; ?>>
                            <?php echo $vo['name']; ?>
                            </span>
                        </a>
                    </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="clear-both"></div>
            </div>


            <?php if(is_array($titleList) || $titleList instanceof \think\Collection || $titleList instanceof \think\Paginator): $i = 0; $__LIST__ = $titleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <div class="every-title">
                    <div class="every-title-picture">
                        <a href="<?php echo url('portal/article/index',['id'=>$vo['id']]); ?>" target="_blank">
                            <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/upload/<?php echo $vo['picture']; ?>" >
                        </a>
                    </div>
                    <div class="every-title-show">
                        <div class="every-title-show-word">
                            <a href="<?php echo url('portal/article/index',['id'=>$vo['id']]); ?>" target="_blank"><?php echo $vo['post_title']; ?></a>
                        </div>
                        <div class="every-title-show-time">
                            【<?php echo date('Y-m-d H:i',$vo['published_time']); ?>】
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </div>

        <div class="right">
            <div class="search" id="search">
                <input  type="text" onfocus="setBorderSelected();" onblur="setBorderUnselected()">
                <div class="search-button" onclick="search()">
                   GO!
                </div>
                <div class="clear"></div>
            </div>
            <div class=" top-box" >
                <div class="top-column">Top 5</div>
                <?php if(is_array($topList) || $topList instanceof \think\Collection || $topList instanceof \think\Paginator): $i = 0; $__LIST__ = $topList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <div class="every-top">
                        <div class="every-top-picture">
                            <a href="<?php echo url('portal/article/index',['id'=>$vo['id']]); ?>" target="_blank">
                                <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/upload/<?php echo $vo['picture']; ?>" >
                            </a>
                        </div>

                        <div class="every-top-show">
                            <a href="<?php echo url('portal/article/index',['id'=>$vo['id']]); ?>" target="_blank"><?php echo $vo['post_title']; ?></a>
                        </div>
                    </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>

            </div>
            <div class="site-info" >
                <h3>友情鏈接</h3>
                <?php if(is_array($links) || $links instanceof \think\Collection || $links instanceof \think\Paginator): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <p ><a href="<?php echo $vo['url']; ?>" target="<?php echo $vo['target']; ?>"><?php echo $vo['name']; ?></a> </p>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

            <div class="site-info" >
                <p > &copy; <?php echo $site_info['site_name']; ?> </p>

            </div>

        </div>

    </div>

</div>
<script>
    nowPage=1;
    $(window).scroll(function() {
        console.log($(document).scrollTop());
        console.log($(document).height()-$(window).height());
        if($(document).scrollTop()+2>=$(document).height()-$(window).height()){
            addHtml('<?php echo !empty($secondCategory)?$secondCategory:$category; ?>');
        }
    });
    function setBorderSelected(){
        $('.search').css('border','1px solid #e8342f');
        return false;
    }
    function setBorderUnselected(){
        $('.search').css('border','1px solid #e8e8e8');
        return false;
    }
    function search(){
        var keyword = $('.search input').val();
        window.open('/portal/Search/index/keyword/'+keyword);
    }


    function addHtml(id){
        nowPage++;
        var catId;
        catId = id
        var html = '';
        $.get("<?php echo url('portal/ajax/getTitles'); ?>",{catId:catId,pageNum:nowPage,pageSize:20},function(data){
            for(var i in data){
                var url = "<?php echo url('portal/article/index'); ?>";
                url = url.slice(0,-5);
                html += '<div class="every-title" id="'+data[i].post_id+'"> <div class="every-title-picture">';
                html +=  '<a href="'+url+'/id/'+data[i].post_id+'.html" target="_blank"><img src="/upload/'+data[i].picture+'" ></a>';
                html +=  '</div><div class="every-title-show"> <div class="every-title-show-word"><a href="'+url+'/id/'+data[i].post_id+'.html" target="_blank">';
                html +=  data[i].post_title+'</a> </div> <div class="every-title-show-time">';
                html +=  '【'+data[i].published_time+'】 </div>  </div>';
                html +=  '<div class="clear"></div> </div>';

            }
            $('.title-box').append(html);
        })
    }

</script>
</body>
</html>
