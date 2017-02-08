<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <!--css-->
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/plugins/jQuery.filer-master/css/jquery.filer.css">
    <link rel="stylesheet" href="/plugins/jQuery.filer-master/css/themes/jquery.filer-dragdropbox-theme.css">
    <link rel="stylesheet" href="/css/jquery.fancybox.css" type="text/css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="/css/style.css">

    <!--js-->
    <script type="text/javascript" src="/js/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/plugins/jQuery.filer-master/js/jquery.filer.min.js"></script>
    <script type="text/javascript" src="/plugins/jQuery.filer-master/js/custom.js"></script>
    <script type="text/javascript" src="/js/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="/js/script_user.js"></script>
    <!--animation-->
    <link href="/css/animate.min.css" rel="stylesheet">
    <script src="/js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
</head>
<body>

<?php
//echo "<pre>";
//var_dump($nghia);
//exit();
//?>
<input type="hidden" class="pagenum" value="1">
<input type="hidden" id="user_id" value="<?php echo $nghia ?>">
<header class="container-fluid">
    <input type="hidden" value="">
    <div class="row menu-header">
        <div class="header-left">
            <h1 class="logo"><a href="/home"><span class="fa fa-tumblr" style="font-size: 35px; color: white"></span></a></h1>
            <form class="form-group search-form">
                <input type="text" class="form-control search-control" placeholder="Search">
            </form>
        </div>
        <div class="header-right">

            <div class="menu-right">
                <ul>
                    <li><a><i class="fa fa-bolt "></i></a></li>
                    <li>
                        <a class="user"><i class="fa fa-user"></i></a>
                        <div id="user-profile">
                            <ul>
                                <li>
                                    <div class="title-profile" style="font-size: 15px">Profile</div>
                                </li>
                                <li>
                                    <a><span class="fa fa-heart"></span> Đéo biết</a>
                                </li>
                                <li>
                                    <a><span class="fa fa-heart"></span> Đéo biết</a>
                                </li>
                                <li>
                                    <a><span class="fa fa-heart"></span> Đéo biết</a>
                                </li>
                                <li>
                                    <a><span class="fa fa-heart"></span> Đéo biết</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li><a><i class="fa fa-smile-o"></i></a></li>
                    <li><a><i class="fa fa-envelope "></i></a></li>
                    <li><a><i class="fa fa-home"></i></a></li>
                    <li>
                        <button class="btn btn-info"><span class="fa fa-pencil" style="font-size: 25px"></span></button>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</header>
<section class="container">
    <div class="home_user_menu_left section-left">
        <ul id="content">
            <li class="menu-section wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.3s">
                <a class="avatar-you">
                    <img class="img-responsive" src="/<?php echo $_SESSION["avatar"] ?>">
                </a>
                <a class="menu-item"><i class="fa fa-text-height fa-3x"
                                        style="color: #4d4d4d;"></i><span>Text</span></a>
                <a data-toggle="modal" href='#upload-image' style="text-decoration: none;" class="menu-item"><i
                        class="fa fa-camera  fa-3x" style="color: #ff5050;"></i><span>Photo</span></a>
                <a class="menu-item"><i class="fa fa-quote-left  fa-3x" style="color: #ff9900;"></i><span>Caption</span></a>
                <a class="menu-item"><i class="fa fa-file-text  fa-3x" style="color: #33cc33;"></i><span>Text</span></a>
                <a class="menu-item"><i class="fa fa-volume-down  fa-3x" style="color: #cc00ff;"></i><span>Audio</span></a>
                <a class="menu-item"><i class="fa fa-video-camera  fa-3x" style="color: #999966;"></i><span>Video</span></a>
            </li>
            <!--            <li class="section-item">-->
            <!--                <div class="post-title">để title</div>-->
            <!--                <div class="post-photo">-->
            <!--                    <a>-->
            <!--                        <img src="/images/albums/demo_1.jpg" alt="" class="img-responsive">-->
            <!--                    </a>-->
            <!--                </div>-->
            <!--                <div class="post-footer">-->
            <!--                    <div class="check-in">-->
            <!--                        <p>username</p>-->
            <!--                        <p>created_at</p>-->
            <!--                        <p>caption</p>-->
            <!--                    </div>-->
            <!--                    <div class="post-tag">-->
            <!--                        <a>tagname</a>-->
            <!--                    </div>-->
            <!--                    <div class="post-icon clearfix">-->
            <!--                        <div class="view-post">-->
            <!--                            248-->
            <!--                        </div>-->
            <!--                        <div class="icon">-->
            <!--                            <a><i class="fa fa-heart-o fa-lg"></i></a>-->
            <!--                            <a><i class="fa fa-exchange fa-lg"></i></a>-->
            <!--                            <a><i class="fa fa-location-arrow fa-lg"></i></a>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </li>-->
        </ul>
    </div>
    <div id="modal">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal_show_image" role="document">
                <div class="modal-content">
                    <div class="modal-body show_image_body">
                        <div class="col-sm-8">
                            <div class="row">
                                <a  data-id="" id="album_id_modal" data-id-im = "">
                                    <img src="" alt="" class="img-responsive image_modal">

                                    <div id="next_modal"><i class="fa fa-angle-right fa-3x"></i></div>
                                    <div id="back_modal"><i class="fa fa-angle-left fa-3x"></i></div>

                                </a>
                            </div>
                        </div>

                        <div class="col-sm-4 ">
                            <div class="row content_row">
                                <div class="static-content">
                                    <div class="avatar_show_image media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img src="images/albums/avatar_demo.jpg" alt="" class=" media-object avatar_modal">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a id="username_modal">Trinh Thị Xuân Cường</a>
                                            <p id="created_at_modal">chỗ này để created_at</p>
                                        </div>
                                    </div>
                                    <p id="title_modal">title sẽ hiện ở đây</p>
                                    <p id="caption_modal">caption sẽ hiện ở đây</p>
                                </div>
                                <div class="icon_show_image clearfix">
                                    <a><i class="fa fa-heart-o fa-lg"></i></a>
                                    <a><i class="fa fa-exchange fa-lg"></i></a>
                                    <a><i class="fa fa-location-arrow fa-lg"></i></a>
                                </div>
                                <div class="comment_show_image">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img src="/images/albums/avatar_demo.jpg" alt="" class=" media-object">
                                            </a>
                                        </div>
                                        <div class="media-body ">
                                            <a>Trịnh Xuân Thanh</a>
                                            <p>tao thử xem là có được không thôi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
