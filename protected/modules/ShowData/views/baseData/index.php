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

    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/Index/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/Index/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/Index/css/vs.min.css">

    <link rel="stylesheet" type="text/css"
          href="<?php echo Yii::app()->request->baseUrl; ?>/statics/Index/css/screen.css">
    <link rel="stylesheet" type="text/css"
          href="<?php echo Yii::app()->request->baseUrl; ?>/statics/Index/css/style.css">
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

    <script>
        var _hmt = _hmt || [];
    </script>
    <script type="text/javascript"
            src="<?php echo Yii::app()->request->baseUrl; ?>/statics/Index/js/ghost-url.min.js"></script>
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
                &nbsp;
                <div class="widget">
                    <h4 class="title"></h4>
                    <div class="content download">
                        <form action="<?php echo $this->createUrl('baseData/search'); ?>" method="post">
                            <div class="form-group">
                                <label>请输入城市名：</label>
                                <input type="text" id="searchInput" value="<?=($cityName) ? $cityName : '';?>" name="searchWord">
                                <button class="btn" style="margin-left: 8%" onclick="searchNews()">搜索</button>
                            </div>
                            <div class="form-group">
                                <label>搜索最多：</label>
                                <?php foreach ($searchCity as $v): ?>
                                    <a href="<?php echo Yii::app()->createUrl('ShowData/BaseData/search/searchWord/' . $v['name']); ?>"> &nbsp;<?=$v['name'];?></a>
                                <?php endforeach;?>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="main-menu">
                    <ul class="menu">
                        <li <?php if ($type == 1): ?>class="nav-current"<?php endif;?> role="presentation">
                            <a href="<?php echo Yii::app()->createUrl('ShowData/BaseData/search/searchWord/' . $cityName); ?>">基础信息</a>
                        </li>
                        <li <?php if ($type == 2): ?>class="nav-current"<?php endif;?> role="presentation">
                            <a href="<?php echo Yii::app()->createUrl('ShowData/BaseData/food/cityName/' . $cityName); ?>" title="美食信息">美食信息</a>
                        </li>
                        <li <?php if ($type == 3): ?>class="nav-current"<?php endif;?> role="presentation">
                            <a href="<?php echo Yii::app()->createUrl('ShowData/BaseData/remark/cityName/' . $cityName); ?>" title="游客评论">游客评论</a>
                        </li>
                        <li <?php if ($type == 4): ?>class="nav-current"<?php endif;?> role="presentation">
                            <a href="<?php echo Yii::app()->createUrl('ShowData/BaseData/picture/cityName/' . $cityName); ?>" title="精选图片">精选图片</a>
                        </li>
                        <li role="presentation"><a href="#" title="著名景点">著名景点</a></li>

                    </ul>
                </div>
            </div>

        </div>

        <?php if ($type == 1): ?>
        <div style="border:1px solid black; margin: 1cm 1cm 1cm 1cm;height: 25cm"  >
            <h2 style="margin: 1cm 20cm 1cm 1cm"><?=$cityData['name'];?></h2>
            <h5 style="margin: -1.5cm 10cm 1cm 1cm"><?=$cityData['address'];?></h5>
            <div style="margin: 2cm 0cm 1cm 1cm">
                <div class="col-md-2">
                    <h5>大家印象：</h5>
                </div>
                <div id="div1"  >
                    <?php foreach ($cityData['tags'] as $key => $v): ?>
                        <a href="#" class="<?=TravelCityData::$color[$key % 5];?>"><?=$v;?></a>
                    <?php endforeach;?>
                </div>
            </div>
            <div style="margin: 1cm 0cm 1cm 1cm">
                <div class="col-md-2">
                    <h5>城市印象：</h5>
                </div>
                <div class="col-md-8">
                    <label><?=$cityData['impression'];?></label>
                </div>
            </div>
            <div style="margin: 3cm 1cm 1cm 1cm">
                <div class="col-md-2">
                    <h5>更多：</h5>
                </div>
                <div class="col-md-8">
                    <label><?=$cityData['moreDesc'];?></label>
                </div>
            </div>
        </div>
        <?php endif;?>


        <?php if ($type == 2 && $foodData): ?>
            <div style="border:1px solid black; margin: 1cm 1cm 1cm 1cm;height: 20cm">
                <h3 style="margin: 1cm 20cm 1cm 1cm"><?=$foodData['name'];?></h3>
                <div style="margin: 1cm 0cm 1cm 1cm">
                    <div class="col-md-2">
                        <h4>美食描述：</h4>
                    </div>
                    <div class="col-md-8">
                        <label><?=$foodData['content'];?></label>
                    </div>
                </div>
                <div style="margin: 4cm 1cm 1cm 1cm">
                    <div class="col-md-2">
                        <h4>美食图片：</h4>
                    </div>
                    <div class="col-md-8">
                        <img src="<?=$foodData['foodPic'];?>" height="400px">
                    </div>
                </div>
                <div style="margin: 1cm 5cm 1cm 1cm">
                    <div class="col-md-12">
                        &nbsp;
                        <?php
$this->widget('CLinkPager', ['pages' => $pages,
    'header'                             => '',
    'htmlOptions'                        => ['class' => 'pagination pagination-m'],
    'selectedPageCssClass'               => 'active']);
?>
                    </div>
                </div>
            </div>
        <?php endif;?>


        <?php if ($type == 3 && $remarkData): ?>
            <div style="margin: 20px 0px 0px 0px">
                <div class="form-group">
                    <label>请输入搜索词：</label>
                    <input type="text" id="searchWord" value="<?=($searchWord) ? $searchWord : '';?>" name="searchWord">
                    <input type="text" id="cityName" name="cityName" value="<?=($cityName) ? $cityName : '';?>" class="hidden">
                    <script language="javascript">
                        function addParam()
                        {
                            var objA=document.getElementById("searchRemark");
                            objA.href="<?php echo Yii::app()->createUrl('ShowData/BaseData/remark/cityName/' . $cityName).'/searchWord/'; ?>"+document.getElementById("searchWord").value;
                        }
                    </script>
                    <a id="searchRemark" href="" onclick="addParam()"><input type="button" value="搜索"></a>
                </div>
                <div class="form-group">
                    <label>常用搜索：</label>
                    <a href="<?php echo Yii::app()->createUrl('ShowData/BaseData/remark/cityName/' . $cityName).'/searchWord/气候'; ?>"> &nbsp;气候</a>
                    <a href="<?php echo Yii::app()->createUrl('ShowData/BaseData/remark/cityName/' . $cityName).'/searchWord/吃'; ?>"> &nbsp;吃</a>
                    <a href="<?php echo Yii::app()->createUrl('ShowData/BaseData/remark/cityName/' . $cityName).'/searchWord/玩'; ?>"> &nbsp;玩</a>
                    <a href="<?php echo Yii::app()->createUrl('ShowData/BaseData/remark/cityName/' . $cityName).'/searchWord/住'; ?>"> &nbsp;住</a>
                    <a href="<?php echo Yii::app()->createUrl('ShowData/BaseData/remark/cityName/' . $cityName).'/searchWord/行'; ?>"> &nbsp;行</a>
                </div>

                <?php foreach ($remarkData as $key => $v): ?>
                    <div style="border:1px solid black; margin: 1cm 1cm 1cm 1cm;height: 8cm">
                        <div style="margin: 1cm 0cm 1cm 1cm">
                            <div class="form-group">
                                <label class="control-label col-md-2">评论时间：</label>
                                <label class="control-label col-md-2"><font color="red"><?=$v['remarkTime'];?></font></label>
                                <label class="control-label col-md-2">用户旅历值：</label>
                                <label class="control-label col-md-2"><font color="#6495ed"><?=$v['highScore'];?></font></label>
                                <label class="control-label col-md-2">评价：</label>
                                <label class="control-label col-md-2"><font color="blue"><?=$v['lowScore'];?></font>星</label>
                            </div>
                            &nbsp;
                            <div class="form-group">
                                <label class="control-label col-md-2">评论内容：</label>
                                <label class="control-label col-md-8"><?=$v['remarkText'];?></label>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
                <div style="margin: 1cm 5cm 1cm 1cm">
                    <div class="col-md-12">
                        &nbsp;
                        <?php
                        $this->widget('CLinkPager', ['pages' => $pages,
                            'header'                             => '',
                            'htmlOptions'                        => ['class' => 'pagination pagination-m'],
                            'selectedPageCssClass'               => 'active']);
                        ?>
                    </div>
                </div>
            </div>


        <?php endif;?>


        <?php if ($type == 4 && $pictureData): ?>
                <div style="border:1px solid black; margin: 1cm 1cm 1cm 1cm;height: 35cm">
                    <div style="margin: 1cm 1cm 1cm 1cm";>
                        <?php foreach ($pictureData as $key => $v): ?>
                            <img width="234" height="234" style="margin:20px 0px 0px 2px" src="<?=$v['pic'];?>">
                        <?php endforeach;?>
                    </div>

                </div>

            <div style="margin: 1cm 5cm 1cm 1cm">
                <div class="col-md-12">
                    &nbsp;
                    <?php
$this->widget('CLinkPager', ['pages' => $pages,
    'header'                             => '',
    'htmlOptions'                        => ['class' => 'pagination pagination-m'],
    'selectedPageCssClass'               => 'active']);
?>
                </div>
            </div>
        <?php endif;?>

    </div>
</nav>
<!-- end navigation -->



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


<script src="<?php echo Yii::app()->request->baseUrl; ?>/statics/Index/js/jquery.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/statics/Index/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/statics/Index/js/jquery.fitvids.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/statics/Index/js/highlight.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/statics/Index/js/main.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/statics/Index/js/h.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/statics/Index/js/3d.js" type="text/javascript"></script>

</body>
</html>

