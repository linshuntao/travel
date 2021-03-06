<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="phpfun 是一个php中文新闻社区">
    <meta name="keywords" content="php中文社区,php框架,php中文网,php framework,restful routing,laravel,laravel php">
    <meta name="HandheldFriendly" content="True">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Ghost 0.7">
    <meta name="referrer" content="origin">

    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl ?>/statics/Index/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl ?>/statics/Index/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl ?>/statics/Index/css/vs.min.css">
    <link rel="stylesheet" type="text/css"
          href="<?php echo Yii::app()->request->baseUrl ?>/statics/Index/css/screen.css">
    <style id="fit-vids-style">.fluid-width-video-wrapper {
            width: 100%;
            position: relative;
            padding: 0;
        }

        .fluid-width-video-wrapper iframe, .fluid-width-video-wrapper object, .fluid-width-video-wrapper embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>

    <script type="text/javascript" charset="utf-8"
            src="<?php echo Yii::app()->request->baseUrl . '/protected/library/ueditor/ueditor.config.js' ?>"></script>
    <script type="text/javascript" charset="utf-8"
            src="<?php echo Yii::app()->request->baseUrl . '/protected/library/ueditor/ueditor.all.min.js' ?>"></script>
    <script>
        var _hmt = _hmt || [];
    </script>
    <script type="text/javascript"
            src="<?php echo Yii::app()->request->baseUrl ?>/statics/Index/js/ghost-url.min.js"></script>
    <script type="text/javascript">
        ghost.init({
            clientId: "ghost-frontend",
            clientSecret: "26b0e31d612d"
        });
    </script>
    <script>
        var commentForm = document.getElementById("commentForm");
        commentForm.style.display = "none";


    </script>

    <title>景点网</title>
</head>

<body class="home-template">


<!-- start header -->
<header class="main-header"
        style="background-image: url(http://image.golaravel.com/5/c9/44e1c4e50d55159c65da6a41bc07e.jpg)"
"="">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1><span class="hide">PHPFun - </span>景点网</h1>
            <h2 class="hide">PHP THAT DOESN'T HURT. CODE HAPPY &amp; ENJOY THE FRESH AIR.</h2>
        </div>
    </div>
</div>
</header>
<!-- end header -->

<!-- start navigation -->
<nav class="main-navigation">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="navbar-header">
                        <span class="nav-toggle-button collapsed" data-toggle="collapse" data-target="#main-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-bars"></i>
                        </span>
                </div>
                <div class="widget">
                    <h4 class="title"></h4>
                    <div class="content download">
                        <form action="<?php echo $this->createUrl('news/searchNews'); ?>" method="post">
                            <input type="text" id="searchInput" name="searchWord">
                            <button class="btn" style="margin-left: 8%" onclick="searchNews()">全站搜索</button>
                        </form>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="main-menu">
                    <ul class="menu">
                        <li class="nav-current" role="presentation"><a
                                href="">基础信息</a></li>
                        <li role="presentation"><a href="#" title="美食信息">美食信息</a>
                        </li>
                        <li role="presentation"><a href="#" title="游客评论"
                            >游客评论</a></li>
                        <li role="presentation"><a href="#" title="著名景点"
                            >著名景点</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- end navigation -->

<?php echo $content; ?>

<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="widget">

                </div>
            </div>
        </div>
    </div>
</footer>

<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <span>Copyright © <a href="">景点网</a></span> |
                <span><a href="" target="_blank">京ICP备11008151号</a></span> |
                <span>京公网安备11010802014853</span>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo Yii::app()->request->baseUrl ?>/statics/Index/js/jquery.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl ?>/statics/Index/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl ?>/statics/Index/js/jquery.fitvids.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl ?>/statics/Index/js/highlight.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl ?>/statics/Index/js/main.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl ?>/statics/Index/js/h.js" type="text/javascript"></script>

</body>
</html>

