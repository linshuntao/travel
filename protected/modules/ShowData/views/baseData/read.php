<script>
    function collection() {
        if ('<?php echo isset(Yii::app()->session['userId']);?>' !== '') {
            jQuery.ajax({
                url: "<?php echo Yii::app()->createUrl('Index/user/collect') . "&newsId=$newsId"?>",
                type: 'post',
                async: false,
                data: "{}",
                dataType: 'json',

                success: function (json) {
                    alert(json.massage);
                    window.location.reload(true);
                },
                error: function (msg) {
                    alert(msg);
                    window.location.reload(true);
                }
            });
        } else {
            if (confirm('您还未登录，点击确定跳转至登录页面：')) {
                window.location.href = '<?php echo Yii::app()->createUrl('Index/login/index');?>';
            }
        }

    }

    function support() {
        jQuery.ajax({
            url: "<?php echo Yii::app()->createUrl('Index/user/support') . "&newsId=$newsId"?>",
            type: 'post',
            async: false,
            data: "{}",
            dataType: 'json',

            success: function (json) {
                alert(json.massage);
                window.location.reload(true);
            },
            error: function (msg) {
                alert(msg);
                window.location.reload(true);
            }
        });
    }

</script>
<!-- start site's main content area -->
<section class="content-wrap">
    <div class="container">
        <div class="row">

            <main class="col-md-8 main-content">

                <article id="66" class="post tag-laravel-5 tag-getting-started-with-laravel tag-laravel-5-2">

                    <div class="post-head">
                        <h1 class="post-title"><a
                                href="#"><?php echo $newsModel[0]->title ?></a>
                        </h1>

                        <div class="post-meta">
                            <span class="author">作者：<?php echo $newsModel[0]->name ?></span> •
                            <time class="post-date" datetime="2016年6月6日星期一下午3点27分" title="2016年6月6日星期一下午3点27分">

                                <?php echo date('Y-m-d H:i:s', $newsModel[0]->updateTime) ?>

                                <?php echo $newsModel[0]->updateTime ?>

                            </time>
                        </div>
                    </div>

                    <div class="post-content">
                        <?php echo html_entity_decode($newsModel[0]->content); ?>
                    </div>


                    <footer class="post-footer clearfix">

                    </footer>

                    <div class="artical-status">
                        <div class="up_down">
                            <a id="up_article" class="btn" href="javascript:;" data-type="up" onclick="support()">
                                <i class="icon"><img
                                        src="<?php echo Yii::app()->request->baseUrl; ?>/statics/Index/images/article-up.png"
                                        alt=""></i>
                                <span class="num"><?php echo $newsModel[0]->supportCount; ?></span>
                                <span class="txt">
                                    <?php
                                    $name = 'isSupport' . $newsModel[0]->id;
                                    echo isset(Yii::app()->session[$name]) && Yii::app()->session[$name] === 1 ? '已点赞' : '点赞';
                                    ?>
                                </span>
                            </a>
                            <a id="down_article" class="btn" href="javascript:;" data-type="down"
                               style="margin-left: 50%" onclick="collection()">
                                <i class="icon"><img
                                        src="<?php echo Yii::app()->request->baseUrl; ?>/statics/Index/images/article-keep.png"></i>
                                <span class="txt">
                                    <?php echo isset($isCollect) && $isCollect === 1 ? '取消收藏' : '收藏'; ?>
                                </span>
                            </a>
                        </div>
                    </div>

                    <!-- JiaThis Button BEGIN -->
                    <div class="jiathis_style_32x32" style="margin-top: 5%">
                        <a class="jiathis_button_qzone"></a>
                        <a class="jiathis_button_tsina"></a>
                        <a class="jiathis_button_weixin"></a>
                        <a class="jiathis_button_douban"></a>
                        <a class="jiathis_button_ishare"></a>
                        <a href="http://www.jiathis.com/share"
                           class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank"></a>
                    </div>
                    <script type="text/javascript">
                        var jiathis_config = {
                            siteNum: 3,
                            sm: "kaixin001,mop,meilishuo",
                            summary: "",
                            boldNum: 3,
                            shortUrl: false,
                            hideMore: true,
                            title: "<?php echo $newsModel[0]->title;?>",
                            summary: "<?php echo $newsModel[0]->digest;?>"
                        }
                    </script>
                    <script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js"
                            charset="utf-8"></script>
                    <!-- JiaThis Button END -->

                    <!--start the UEditor's init javascript-->
                    <script>
                        var ue = UE.getEditor('content', {
                            toolbars: [
                                ['emotion']
                            ],
                            autoHeightEnabled: true,
                            autoFloatEnabled: true
                        });
                    </script>
                    <!--end the UEditor's init javascript-->
                    <br/>
                    <br/>
                    <footer class="post-footer clearfix">
                    </footer>
                    <!--start the comment's content area-->
                    <?php
                    foreach ($newsComment as $v) {
                        ?>
                        <label><?php echo $v->name; ?> </label>
                        <?php
                        if ($v->pId != 0) {

                            echo ' 评论 ';
                            for ($i = 0; $i < count($newsComment); $i++) {
                                //echo $newsComment[i]->id;
                                if ($v->pId == $newsComment[$i]->id) {
                                    echo $newsComment[$i]->name . '<br> ';
                                    $i = count($newsComment);
                                }
                            }
                        } else {
                            echo '<br>';
                        }
                        ?>
                        <label><?php echo $v->content; ?> </label>
                        <br>
                        <label><?php echo date('Y-m-d H:i:s', $v->commentTime); ?> </label>
                        <label style="float: right">点赞：<?php echo $v->supportCount; ?> </label>

                        <footer class="post-footer clearfix">
                        </footer>
                        <?php

                    };
                    ?>
                    <?php
                    $this->widget('CLinkPager', array(
                        'pages' => $pages,
                        'header' => false,
                        'htmlOptions' => array('class' => 'pagination pull-right'),
                        'selectedPageCssClass' => 'active',
                        'hiddenPageCssClass' => 'disabled',
                        'firstPageLabel' => '首页',
                        'lastPageLabel' => '尾页',
                        'prevPageLabel' => '«',
                        'nextPageLabel' => '»',
                        'maxButtonCount' => 5,
                        'cssFile' => false,
                        'firstPageCssClass' => 'previous',
                        'lastPageCssClass' => 'next',
                    ));
                    ?>
                    <!--start the commentForm area-->
                    <div id="commentForm" style=" margin-top:15%">
                        <div class="form">
                            <?php $form = $this->beginWidget('CActiveForm', array(
                                'enableClientValidation' => true,
                                'clientOptions' => array(
                                    'validateOnsubmit' => true
                                ),
                            )); ?>
                            <?php echo $form->textArea($comment, 'content', array(
                                'id' => 'content', 'type' => 'text/plain', 'value' => '', 'style' => 'width:650px;height:100px;margin-top:10px;margin-bottom:10px;clear:both'));
                            ?>
                            <?php echo $form->error($comment, 'content', array('style' => 'color:red')); ?>
                            <input type="submit" value="评论" style="float: right; margin-right: 5%"/>
                            <?php $this->endWidget() ?>
                        </div>
                    </div>
                    <!--end the commentForm area-->

                    </footer>

                </article>

            </main>

            <aside class="col-md-4 sidebar">

                <!-- start search widget -->
                <div class="widget">
                    <h4 class="title"></h4>
                    <div class="content download">
                        <form action="<?php echo $this->createUrl('news/searchNews'); ?>" method="post">
                            <input type="text" id="searchInput" name="searchWord">
                            <button class="btn" style="margin-left: 8%" onclick="searchNews()">全站搜索</button>
                        </form>
                    </div>
                </div>
                <!-- end search widget -->

                <!-- start tag cloud widget -->
                <div class="widget">
                    <h4 class="title">社区</h4>

                    <div class="content community">
                        <p>QQ群：123456</p>

                        <p><a href="#" title="PHPfun问答社区" target="_blank"
                              onclick="_hmt.push([&#39;_trackEvent&#39;, &#39;big-button&#39;, &#39;click&#39;, &#39;问答社区&#39;])"><i
                                    class="fa fa-comments"></i> 问答社区</a></p>
                    </div>
                </div>
                <!-- end tag cloud widget -->

                <!-- start widget -->

                <h4 class="title"></h4>
                <div class="content download">
                    <a href="http://www.php.net/" class="btn btn-default btn-block">PHP官网</a>
                </div>
        </div>
        <!-- end widget -->
        </aside>

    </div>
    </div>
</section>