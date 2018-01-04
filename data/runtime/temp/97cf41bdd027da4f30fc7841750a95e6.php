<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:61:"themes/admin_simpleboot3/count\count_article_vistor\real.html";i:1515027555;s:43:"themes/admin_simpleboot3/public\header.html";i:1511839833;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->


    <link href="__TMPL__/public/assets/themes/<?php echo cmf_get_admin_style(); ?>/bootstrap.min.css" rel="stylesheet">
    <link href="__TMPL__/public/assets/simpleboot3/css/simplebootadmin.css" rel="stylesheet">
    <link href="__STATIC__/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style>
        form .input-order {
            margin-bottom: 0px;
            padding: 0 2px;
            width: 42px;
            font-size: 12px;
        }

        form .input-order:focus {
            outline: none;
        }

        .table-actions {
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 0px;
        }

        .table-list {
            margin-bottom: 0px;
        }

        .form-required {
            color: red;
        }
    </style>
    <script type="text/javascript">
        //全局变量
        var GV = {
            ROOT: "__ROOT__/",
            WEB_ROOT: "__WEB_ROOT__/",
            JS_ROOT: "static/js/",
            APP: '<?php echo \think\Request::instance()->module(); ?>'/*当前应用名*/
        };
    </script>
    <script src="__TMPL__/public/assets/js/jquery-1.10.2.min.js"></script>
    <script src="__STATIC__/js/wind.js"></script>
    <script src="__TMPL__/public/assets/js/bootstrap.min.js"></script>
    <script>
        Wind.css('artDialog');
        Wind.css('layer');
        $(function () {
            $("[data-toggle='tooltip']").tooltip();
            $("li.dropdown").hover(function () {
                $(this).addClass("open");
            }, function () {
                $(this).removeClass("open");
            });
        });
    </script>
    <?php if(APP_DEBUG): ?>
        <style>
            #think_page_trace_open {
                z-index: 9999;
            }
        </style>
    <?php endif; ?>
</head>
<body>
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li <?php if($type == 'all'): ?>class="active",<?php endif; ?> ><a href="<?php echo url('CountArticleVistor/index'); ?>">文章访客统计</a></li>
        <li <?php if($type == 'real'): ?>class="active",<?php endif; ?> ><a href="<?php echo url('CountArticleVistor/real'); ?>">真实访客统计</a></li>
    </ul>
    <form class="well form-inline margin-top-20" method="post" action="<?php echo url('CountArticleVistor/real'); ?>">

        时间:
        <input type="text" class="form-control js-bootstrap-date" name="start_time"
               value="<?php echo (isset($start_time) && ($start_time !== '')?$start_time:empty($sTime))?'':$sTime; ?>"
               style="width: 140px;" autocomplete="off">-
        <input type="text" class="form-control js-bootstrap-date" name="end_time"
               value="<?php echo (isset($end_time) && ($end_time !== '')?$end_time:empty($eTime))?'':$eTime; ?>"
               style="width: 140px;" autocomplete="off"> &nbsp; &nbsp;

        <input type="submit" class="btn btn-primary" value="搜索"/>
        <a class="btn btn-danger" href="<?php echo url('CountArticleVistor/index'); ?>">清空</a>
    </form>
    <form class="js-ajax-form" action="" method="post">
        <div class="table-actions">
            <?php if(!(empty($category) || (($category instanceof \think\Collection || $category instanceof \think\Paginator ) && $category->isEmpty()))): ?>
                <button class="btn btn-primary btn-sm js-ajax-submit" type="submit"
                        data-action="<?php echo url('AdminArticle/listOrder'); ?>"><?php echo lang('SORT'); ?>
                </button>
            <?php endif; ?>

        </div>
        <table class="table table-hover table-bordered table-list">
            <thead>
            <tr>
                <th width="50">作者</th>
                <th width="50">文章名称</th>
                <th width="80">来源</th>
                <th width="80">ip</th>
                <th width="80">时间</th>
                <th width="80">终端</th>

            </tr>
            </thead>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
                <tr>
                    <td>
                        <?php echo $vo['username']; ?>
                    </td>

                    <td>
                        <?php echo $vo['post_id']; ?>
                    </td>

                    <td>
                        <?php echo $vo['from_url']; ?>
                    </td>

                    <td>
                        <?php echo $vo['real_ip']; ?>
                    </td>

                    <td>
                        <?php echo $vo['create_time']; ?>
                    </td>
                    <td>
                        <?php echo !empty($vo['is_mobile'])?'手机':'电脑'; ?>
                    </td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </table>

        <ul class="pagination"><?php echo (isset($page) && ($page !== '')?$page:''); ?></ul>
    </form>
</div>
<script src="__STATIC__/js/admin.js"></script>
<script>

    function reloadPage(win) {
        win.location.reload();
    }


</script>
</body>
</html>