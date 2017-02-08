<section class="container">
    <div class="section-left">
        <ul>
            <!--            <li class="menu-section wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.3s">-->
            <!--                <a class="avatar-you">-->
            <!--                    <img class="img-responsive" src="/images/demo-avatar.jpg">-->
            <!--                </a>-->
            <!--                <a class="menu-item"><i class="fa fa-text-height fa-3x"-->
            <!--                                        style="color: #4d4d4d;"></i><span>Text</span></a>-->
            <!--                <a data-toggle="modal" href='#upload-image' style="text-decoration: none;" class="menu-item"><i-->
            <!--                            class="fa fa-camera  fa-3x" style="color: #ff5050;"></i><span>Photo</span></a>-->
            <!--                <a class="menu-item"><i class="fa fa-quote-left  fa-3x" style="color: #ff9900;"></i><span>Caption</span></a>-->
            <!--                <a class="menu-item"><i class="fa fa-file-text  fa-3x" style="color: #33cc33;"></i><span>Text</span></a>-->
            <!--                <a class="menu-item"><i class="fa fa-volume-down  fa-3x" style="color: #cc00ff;"></i><span>Audio</span></a>-->
            <!--                <a class="menu-item"><i class="fa fa-video-camera  fa-3x" style="color: #999966;"></i><span>Video</span></a>-->
            <!--            </li>-->
            <li class="section-item">
                <form action="/posts/edit/<?php echo $albumId ?>" method="POST" role="form">
                    <div>
                        <p>
                            <?php
                            if (isset($_SESSION["error"])) {
                                foreach ($_SESSION["error"] as $error) {
                                    echo $error;
                                }
                            }
                            ?>
                        </p>
                    </div>
                    <div class="avatar-post">
                        <a class="avatar-img">
                            <img class="img-responsive img_post" src="/images/demo-avatar.jpg">
                            <input type="hidden" name="_method" value="PUT">
                        </a>
                    </div>
                    <?php
                    foreach ($allAlbumImage as $allAlbumImage) {
                        ?>
                        <div class="post-photo">
                            <img src="/<?php echo $allAlbumImage["link"] ?>" class="img-responsive"
                                 style="width: 100%;">
                        </div>
                        <div class="image-title">
                            <textarea class="form-control caption-image-edit" name="caption-image-edit-<?php echo $allAlbumImage["image_id"] ?>" rows="2"
                                      placeholder="Caption Image"></textarea>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="post-title">
                        <textarea class="form-control caption-album-edit" name="caption-album-edit" rows="3"
                                  placeholder="Caption Album"></textarea>
                    </div>
                    <div class="post-footer">
                        <div class="post-tag">
                            <textarea class="form-control tag-album-edit" name="tag-album-edit" rows="1"
                                      placeholder="Tags"></textarea>
                        </div>
                        <div class="post-icon clearfix">
                            <button type="submit" class="btn btn-primary btn-edit" name="btn-edit" style="float: right;">Save</button>
                        </div>
                    </div>
                </form>
            </li>
        </ul>
    </div>
    <div class="section-right">
        <div class="add_blog_0">
            <div class="title-column">
                <h4>Gợi ý kết bạn</h4>
            </div>
            <ul class="add_blog">
                <li>
                    <div class="row" style="display:block">
                        <div class="col-md-12">
                            <div class="col-sm-2">
                                <img src="/images/demo-avatar.jpg" class="img-responsive">
                            </div>
                            <div class="col-sm-8">
                                <div class="content-f">
                                    <p>the mini fashion blog</p>
                                    <i>The mini</i>
                                </div>
                            </div>
                            <div class="blog_add col-sm-2">
                                <a><span class="fa fa-plus-square fa-2x "></span></a>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row" style="display:block">
                        <div class="col-md-12">
                            <div class="col-sm-2">
                                <img src="/images/demo-avatar.jpg" class="img-responsive">
                            </div>
                            <div class="col-sm-8">
                                <div class="content-f">
                                    <p>the mini fashion blog</p>
                                    <i>The mini</i>
                                </div>
                            </div>
                            <div class="blog_add col-sm-2">
                                <a><span class="fa fa-plus-square fa-2x "></span></a>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row" style="display:block">
                        <div class="col-md-12">
                            <div class="col-sm-2">
                                <img src="/images/demo-avatar.jpg" class="img-responsive">
                            </div>
                            <div class="col-sm-8">
                                <div class="content-f">
                                    <p>the mini fashion blog</p>
                                    <i>The mini</i>
                                </div>
                            </div>
                            <div class="blog_add col-sm-2">
                                <a><span class="fa fa-plus-square fa-2x "></span></a>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row" style="display:block">
                        <div class="col-md-12">
                            <div class="col-sm-2">
                                <img src="/images/demo-avatar.jpg" class="img-responsive">
                            </div>
                            <div class="col-sm-8">
                                <div class="content-f">
                                    <p>the mini fashion blog</p>
                                    <i>The mini</i>
                                </div>
                            </div>
                            <div class="blog_add col-sm-2">
                                <a><span class="fa fa-plus-square fa-2x "></span></a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="add_fn">
            <div class="add_blog_0">
                <div class="title-column">
                    <h4>Bố éo biết </h4>
                </div>
                <ul class="add_blog">
                    <li>
                        <div class="row" style="display:block">
                            <div class="col-md-12">
                                <div class="col-sm-2">
                                    <img src="/images/demo-avatar.jpg" class="img-responsive">
                                </div>
                                <div class="col-sm-8">
                                    <div class="content-f">
                                        <p>the mini fashion blog</p>
                                        <i>The mini</i>
                                    </div>
                                </div>
                                <div class="blog_add col-sm-2">
                                    <a><span class="fa fa-plus-square fa-2x "></span></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="img-add">
                        <img src="/images/demo_right.jpg" class="img-responsive">
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="hidden-right-menu wow fadeInRight" data-wow-delay="0.1s">
        <div class="header-user">
            <div class="menu-header-user">
                <div class="banner-user">
                    <img src="/images/banner_user.jpg" alt="" class="img-responsive">
                </div>
                <div class="menu-user">
                    <div class="name-user">
                        <span>chanboba</span>
                    </div>
                    <div class="menu-user-right">
                        <ul>
                            <li>
                                <a href="" class="btn btn-primary">Follow</a>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-user fa-lg"></i></a>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-plus-circle fa-lg"></i></a>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-share fa-lg"></i></a>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-search fa-lg"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="avatar-user">
                    <img src="/images/avatar_demo.jpg" class="img-responsive " alt="">
                </div>

            </div>
            <div class="section-user">
                <p class="text-center">
                    Nguyễn Thìn Đẹp
                </p>
                <div class="section-user-conten-item">
                    <div class="post-title">
                        <p>Bộ ảnh gì không biết</p>
                    </div>
                    <div class="post-photo">
                        <img src="/images/demo.jpg" class="img-responsive">
                    </div>
                    <div class="post-icon clearfix">
                        <div class="caption_user">
                            <span>chưa biết viết gì luôn</span>
                        </div>
                        <div class="view-post">View: 248</div>
                        <div class="icon">
                            <a><i class="fa fa-heart-o fa-lg"></i></a>
                            <a><i class="fa fa-eavatar-userxchange fa-lg"></i></a>
                            <a><i class="fa fa-location-arrow fa-lg"></i></a>
                        </div>
                    </div>
                </div>
                <div class="section-user-conten-item">
                    <div class="post-title">
                        <p>Bộ ảnh gì không biết</p>
                    </div>
                    <div class="post-photo">
                        <img src="/images/demo.jpg" class="img-responsive">
                    </div>
                    <div class="post-icon clearfix">
                        <div class="caption_user">
                            <span>chưa biết viết gì luôn</span>
                        </div>
                        <div class="view-post">View: 248</div>
                        <div class="icon">
                            <a><i class="fa fa-heart-o fa-lg"></i></a>
                            <a><i class="fa fa-exchange fa-lg"></i></a>
                            <a><i class="fa fa-location-arrow fa-lg"></i></a>
                        </div>
                    </div>
                </div>
                <div class="section-user-conten-item">
                    <div class="post-title">
                        <p>Bộ ảnh gì không biết</p>
                    </div>
                    <div class="post-photo">
                        <img src="/images/demo.jpg" class="img-responsive">
                    </div>
                    <div class="post-icon clearfix">
                        <div class="caption_user">
                            <span>chưa biết viết gì luôn</span>
                        </div>
                        <div class="view-post">View: 248</div>
                        <div class="icon">
                            <a><i class="fa fa-heart-o fa-lg"></i></a>
                            <a><i class="fa fa-exchange fa-lg"></i></a>
                            <a><i class="fa fa-location-arrow fa-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hidden-left wow fadeInLeft" data-wow-delay="0.1s">

    </div>
</section>

<div class="modal fade" id="upload-image">
    <div class="modal-dialog">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <input type="file" name="files[]" id="filer_input2" multiple="multiple">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-create" name="btn-create">Post</button>
                </div>
            </div>
        </form>
    </div>
</div>


</body>
</html>