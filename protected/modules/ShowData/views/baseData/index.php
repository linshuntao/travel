<!-- start site's main content area -->
<section class="content-wrap">
    <div class="container">
        <div class="row">
            <main class="col-md-8 main-content">


            </main>
            <!-- //使用bootstrap样式分页 -->

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

            </aside>
        </div>
    </div>
</section>
