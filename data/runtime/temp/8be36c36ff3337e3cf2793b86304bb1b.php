<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:37:"themes/simpleboot3/portal\\index.html";i:1514340526;s:39:"themes/simpleboot3/public\googleAd.html";i:1512106702;s:40:"themes/simpleboot3/public\headerTop.html";i:1513231504;}*/ ?>
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
<?php if(is_array($catSecondList) || $catSecondList instanceof \think\Collection || $catSecondList instanceof \think\Paginator): $i = 0; $__LIST__ = $catSecondList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <div class="spiderUrl" style="display:none">
        <a href="<?php echo url('portal/list/index',['id'=>$vo['id']]); ?>"><?php echo $vo['name']; ?></a>
    </div>
<?php endforeach; endif; else: echo "" ;endif; ?>
<div class="container">
    <div class="middle">
        <div class="home">
            <a href="<?php echo url('portal/index/index'); ?>"><?php echo (isset($site_info['site_name']) && ($site_info['site_name'] !== '')?$site_info['site_name']:''); ?></a>
        </div>
        <div class="cat-box">
                <div class="every-cat"  style="background:#ed4040;">
                    <a href="<?php echo url('portal/index/index'); ?>">最新</a>
                </div>
            <?php if(is_array($catList) || $catList instanceof \think\Collection || $catList instanceof \think\Paginator): $i = 0; $__LIST__ = $catList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <div class="every-cat">
                    <a href="<?php echo url('portal/index/getSecondCat',['cid'=>$vo['id']]); ?>"><?php echo $vo['name']; ?></a>
                </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>

        <div class="title-box ">

            <div class="player">
                <div class="player-picture">
                    <?php if(is_array($slideList) || $slideList instanceof \think\Collection || $slideList instanceof \think\Paginator): $i = 0; $__LIST__ = $slideList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <div class="player-picture-every" id="img-<?php echo $key+1; ?>">
                            <a href="<?php echo $vo['url']; ?>" target="blank"><img src="/upload/<?php echo $vo['image']; ?>"></a>
                        </div>
                        <div class="player-picture-every-title" id="img-title-<?php echo $key+1; ?>">
                            <?php echo $vo['content']; ?>
                        </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="player-title">
                    <?php if(is_array($slideList) || $slideList instanceof \think\Collection || $slideList instanceof \think\Paginator): $i = 0; $__LIST__ = $slideList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <div class="player-title-every" id="player-<?php echo $key+1; ?>">
                            <?php echo $vo['title']; ?>
                        </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="clear">
                </div>
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
                <p ><a href="__TMPL__/public/secret.html">隱私條款</a> </p>

            </div>

        </div>

    </div>

</div>
<script>
    nowId='cat-0';
    nowPage=1;
    showId = 0;

    $(function () {

        show();
        player = self.setInterval(show,3000);

        $(window).scroll(function() {
            console.log($(document).scrollTop());
            console.log($(document).height()-$(window).height());
            if($(document).scrollTop()+2>=$(document).height()-$(window).height()){
                addHtml(nowId);
            }
        });

        $('.player-title-every').mouseover(function(){
            showId = $(this).attr('id').substr(7)-1;
            show();
            window.clearInterval(player);
        })

        $('.player-title-every').mouseout(function(){
            player = self.setInterval(show,3000);
        })

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
        window.open('/portal/search/index/keyword/'+keyword);
    }

    function addHtml(id){
        nowPage++;
        var catId;
        catId = id.substring(4);
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

    function show(){
        var num = parseInt(showId/6);
        id = showId - num*6+1;
        $('.player-title-every').css('background-color','');
        $('#player-'+id).css('background-color','#ed4040');
        $('.player-picture-every').hide();
        $('.player-picture-every-title').hide();
        $('#img-'+id).show();
        $('#img-title-'+id).show();
        showId++;
    }


</script>
</body>
</html>
