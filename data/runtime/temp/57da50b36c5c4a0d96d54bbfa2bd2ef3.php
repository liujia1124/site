<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:38:"themes/simpleboot3/portal\article.html";i:1514875002;s:35:"themes/simpleboot3/public\head.html";i:1513229329;s:39:"themes/simpleboot3/public\function.html";i:1508310601;s:39:"themes/simpleboot3/public\googleAd.html";i:1512106702;s:40:"themes/simpleboot3/public\headerTop.html";i:1513231504;s:38:"themes/simpleboot3/public\scripts.html";i:1510733341;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $article['post_title']; ?></title>
    <meta name="keywords" content="<?php echo (isset($article['post_keywords']) && ($article['post_keywords'] !== '')?$article['post_keywords']:''); ?>"/>
    <meta name="description" content="<?php echo (isset($article['post_excerpt']) && ($article['post_excerpt'] !== '')?$article['post_excerpt']:''); ?>">
    
<?php 
/*可以加多个方法哟！*/
function _sp_helloworld(){
	echo "hello ThinkCMF!";
}

function _sp_helloworld2(){
	echo "hello ThinkCMF2!";
}


function _sp_helloworld3(){
	echo "hello ThinkCMF3!";
}

 ?>
<meta name="author" content="ThinkCMF">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">

<!-- No Baidu Siteapp-->
<meta http-equiv="Cache-Control" content="no-siteapp"/>

<!-- HTML5 shim for IE8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->
<link rel="icon" href="__TMPL__/public/assets/images/favicon.png" type="image/png">
<link rel="shortcut icon" href="__TMPL__/public/assets/images/favicon.png" type="image/png">
<link href="__TMPL__/public/assets/css/siteIndex.css" rel="stylesheet">
<link href="__TMPL__/public/assets/simpleboot3/themes/simpleboot3/bootstrap.min.css" rel="stylesheet">
<link href="__TMPL__/public/assets/simpleboot3/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"
      type="text/css">
<!--[if IE 7]>
<link rel="stylesheet" href="__TMPL__/public/assets/simpleboot3/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
<![endif]-->
<link href="__TMPL__/public/assets/css/style.css" rel="stylesheet">
<style>
    /*html{filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(1);}*/
    #backtotop {
        position: fixed;
        bottom: 50px;
        right: 20px;
        display: none;
        cursor: pointer;
        font-size: 50px;
        z-index: 9999;
    }

    #backtotop:hover {
        color: #333
    }

    #main-menu-user li.user {
        display: none
    }
</style>
<script type="text/javascript">
    //全局变量
    var GV = {
        ROOT: "__ROOT__/",
        WEB_ROOT: "__WEB_ROOT__/",
        JS_ROOT: "public/static/js/"
    };
</script>
<script src="__TMPL__/public/assets/js/jquery-1.10.2.min.js"></script>
<script src="__TMPL__/public/assets/js/jquery-migrate-1.2.1.js"></script>
<script src="__STATIC__/js/wind.js"></script>
	

    
    <style>
        #article_content img {
            height: auto !important;
            max-width: 100%;
        }

        #article_content {
            word-wrap: break-word;
        }
    </style>
</head>
<body class="body-white" style="margin:0px;padding: 0px;">

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


<div class="container tc-main">
    <div class="row">
        <div class="col-md-9">
            <div class="tc-box article-box">
                <div style='text-align: center;'><h2><?php echo $article['post_title']; ?></h2></div>
                <div class="article-infobox" style='text-align: right;color: #FF7518'>
                    <span ><?php echo date('Y-m-d H:i',$article['published_time']); ?> </span>

                </div>
                <hr>
                <div id="article_thmbnail" style="visibility: hidden;width: 0px;height: 0px">
                    <?php if(!(empty($article['more']['thumbnail']) || (($article['more']['thumbnail'] instanceof \think\Collection || $article['more']['thumbnail'] instanceof \think\Paginator ) && $article['more']['thumbnail']->isEmpty()))): $file_url=cmf_get_file_download_url($article['more']['thumbnail']); ?>
                        <img src="<?php echo $file_url; ?>" >
                    <?php endif; ?>
                </div>
                <div id="article_content">
                    <?php echo $article['post_content']; ?>
                </div>



                <?php 
                    $after_content_hook_param=[
                    'object_id'=>$article['id'],
                    'table_name'=>'portal_post',
                    'object_title'=>$article['post_title'],
                    'user_id'=>$article['user_id'],
                    'url'=>cmf_url_encode('portal/Article/index',array('id'=>$article['id'],'cid'=>$category['id'])),
                    'object'=>$article
                    ];
                 
    \think\Hook::listen('after_content',$after_content_hook_param,null,false);
 
                    $comment_hook_param=[
                    'object_id'=>$article['id'],
                    'table_name'=>'portal_post',
                    'object_title'=>$article['post_title'],
                    'url'=>cmf_url_encode('portal/Article/index',array('id'=>$article['id'],'cid'=>$category['id']))
                    ];
                    $comment=hook_one('comment',$comment_hook_param);
                 ?>


            </div>
            <?php if(!(empty($article['more']['files'][0]['url']) || (($article['more']['files'][0]['url'] instanceof \think\Collection || $article['more']['files'][0]['url'] instanceof \think\Paginator ) && $article['more']['files'][0]['url']->isEmpty()))): $file_url=cmf_get_file_download_url($article['more']['files'][0]['url']); ?>
                附件：<a href="<?php echo $file_url; ?>" download><?php echo $article['more']['files'][0]['name']; ?></a>
            <?php endif; ?>


        </div>

        <div class="col-md-3">
            <div class="tc-box first-box">
                <div class="headtitle">
                    <h2>Top 5</h2>
                </div>
                <div class="ranking">
                    <?php 
                        $hot_articles=[];
                     ?>
                    <ul class="list-unstyled">
                        <?php
$articles_data = \app\portal\service\ApiService::articles([
    'field'   => '',
    'where'   => "",
    'limit'   => '5',
    'order'   => 'post.post_hits DESC',
    'page'    => '',
    'relation'=> '',
    'category_ids'=>''
]);

$__PAGE_VAR_NAME__ = isset($articles_data['page'])?$articles_data['page']:'';

 if(is_array($articles_data['articles']) || $articles_data['articles'] instanceof \think\Collection || $articles_data['articles'] instanceof \think\Paginator): $i = 0; $__LIST__ = $articles_data['articles'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;$top=$key<3?"top3":""; ?>
                            <li class="<?php echo $top; ?>">
                                <i><?php echo $key+1; ?></i>
                                <a title="<?php echo $vo['post_title']; ?>"
                                   href="<?php echo url('portal/article/index',array('id'=>$vo['id'])); ?>">
                                    <?php echo $vo['post_title']; ?>
                                </a>
                            </li>
                        
<?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="__TMPL__/public/assets/simpleboot3/bootstrap/js/bootstrap.min.js"></script>
    <script src="__STATIC__/js/frontend.js"></script>
	<script>
	$(function(){
		$("#main-menu li.dropdown").hover(function(){
			$(this).addClass("open");
		},function(){
			$(this).removeClass("open");
		});
		
		$("#main-menu a").each(function() {
			if ($(this)[0].href == String(window.location)) {
				$(this).parentsUntil("#main-menu>ul>li").addClass("active");
			}
		});
		
		$.post("<?php echo url('user/index/isLogin'); ?>",{},function(data){
		    console.log(data);
			if(data.code==1){
				if(data.data.user.avatar){
				}

				$("#main-menu-user span.user-nickname").text(data.data.user.user_nickname?data.data.user.user_nickname:data.data.user.user_login);
				$("#main-menu-user li.login").show();
                $("#main-menu-user li.offline").hide();

			}

			if(data.code==0){
                $("#main-menu-user li.login").hide();
				$("#main-menu-user li.offline").show();
			}

		});

        ;(function($){
			$.fn.totop=function(opt){
				var scrolling=false;
				return this.each(function(){
					var $this=$(this);
					$(window).scroll(function(){
						if(!scrolling){
							var sd=$(window).scrollTop();
							if(sd>100){
								$this.fadeIn();
							}else{
								$this.fadeOut();
							}
						}
					});
					
					$this.click(function(){
						scrolling=true;
						$('html, body').animate({
							scrollTop : 0
						}, 500,function(){
							scrolling=false;
							$this.fadeOut();
						});
					});
				});
			};
		})(jQuery); 
		
		$("#backtotop").totop();
		
		
	});
	</script>



<script>
    var postId = '<?php echo $article['id']; ?>';
    var userId = '<?php echo $article['user_id']; ?>';
    var host   = '<?php echo $host; ?>';
    $(function(){

        $.post("<?php echo url('portal/article/logPostVisitor'); ?>",{userId:userId, postId:postId,host:host },function(data){
            console.log(data);
        })

    })
</script>

</body>
</html>