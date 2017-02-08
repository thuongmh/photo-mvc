<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--css-->
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/plugins/jQuery.filer-master/css/jquery.filer.css">
    <link rel="stylesheet" href="/plugins/jQuery.filer-master/css/themes/jquery.filer-dragdropbox-theme.css">
    <link rel="stylesheet" href="/plugins/jQuery.filer-master/css/themes/jquery.filer-dragdropbox-theme.css">
    <link rel="stylesheet" href="/plugins/bootstrap3-editable-1.5.1/bootstrap3-editable/css/bootstrap-editable.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">

    <!--js-->
    <script type="text/javascript" src="/js/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/plugins/jQuery.filer-master/js/jquery.filer.min.js"></script>
    <script type="text/javascript" src="/plugins/jQuery.filer-master/js/custom.js"></script>
    <script type="text/javascript" src="/plugins/fancybox/jquery.fancybox.pack.js"></script>
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.jquery.min.js"></script>
    <script src="/plugins/bootstrap3-editable-1.5.1/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
    <!--animation-->
    <link href="/css/animate.min.css" rel="stylesheet">
    <script src="/js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
</head>
<body>
<input type="hidden" class="pagenum" value="1">
<header class="container-fluid">
    <div class="row menu-header menu-desktop">
        <div class="header-left col-xs">
            <h1 class="logo"><span class="fa fa-tumblr" style="font-size: 35px; color: white"></span></h1>
            <form class="form-group search-form">
                <input type="text" class="form-control search-control aa-input-search" placeholder="Search">
            </form>
        </div>
        <div class="header-right">

            <div class="menu-right">
                <ul>
                    <li><a href="/users/logout" id="btn-logout"><i class="fa fa-power-off" aria-hidden="true"></i></i>
                        </a></li>
                    <li>
                        <a class="user"><i class="fa fa-user"></i></a>
                        <div id="user-profile">
                            <ul>
                                <li>
                                    <div class="title-profile"
                                         style="font-size: 15px; font-weight: 700"><?php echo $_SESSION["username"] ?></div>
                                </li>
                                <li>
                                    <a>Profile</a>
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
    <div class="row menu-mobile">
        <div class="mobile-logo">
            <span class="fa fa-tumblr fa-2x"></span>
        </div>
        <div class="menu-mobile-right">
            <ul>
                <li id="search-mobile"><a href="#"><i class="fa fa-search"></i></a></li>
                <li><a href="/users/logout" id="btn-logout"><i class="fa fa-power-off" aria-hidden="true"></i></i>
                    </a></li>
                <li>
                    <a class="user"><i class="fa fa-user"></i></a>
                </li>
                <li><a><i class="fa fa-home"></i></a></li>
                <form class="form-inline search-mobile-div">
                    <div class=" input-group wow fadeInRight  " data-wow-duration="1s" data-wow-delay="0.3s">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    </div>
                </form>
            </ul>
        </div>
    </div>
</header>
<section>
    <aside class="main-sidebar">
        <div class="icon" style="padding: 20px">
            <img src="<?php echo $profile['avatar'] ?>"
                 style="width: 70px; height: 70px; border-radius: 5px; margin: auto auto; margin-bottom: 20px"
                 class="img-responsive">
            <h3 style="text-align: center;color: white"><?php echo $profile['username'] ?></h3>
        </div>
        <ul class="sidebar-menu list-group">
            <li class="list-group-item">
                <a href="/profiprofile-user-1le">Thông tin chung</a>
            </li>
            <div class="clearfix"></div>
            <li class="list-group-item">
                <a href="/users/reset">Thay đổi mật khẩu</a>
            </li>
            <div class="clearfix"></div>
            <li class="list-group-item">
                <a>Tin nhắn</a>
            </li>

        </ul>
    </aside>
    <div class="container" id="profile-user-1">
        <input type="hidden" value="<?php echo $_SESSION['user_id'] ?>" id="user_id_dkm">
        <form action="" enctype="multipart/form-data" class="form-horizontal" id="form-profile">
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2 avatar-profile-user">
                    <img src="/<?php echo $profile['avatar'] ?>" alt="" class="img-responsive">
                    <input type="button" class="btn btn-primary" value="Đổi Avatar" data-toggle="modal"
                           data-target="#myModal_avatar">
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2">Fullname</label>
                <div class="col-sm-10">
                    <a href="#" id="fullname"><?php echo $profile['fullname'] ?></a>
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2">Username</label>
                <div class="col-sm-10">
                    <a href="#" id="username"><?php echo $profile['username'] ?></a>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2">Email</label>
                <div class="col-sm-10">
                    <a href="#" id="email"><?php echo $profile['email'] ?></a>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2">Description</label>
                <div class="col-sm-10">
                    <a href="#" id="description" data-type="textarea"
                       style="display: block"><?php echo $profile['description'] ?></a>
                </div>
            </div>
        </form>
        <div class="modal fade" id="myModal_avatar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="users/updateAvatar" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Thay Avatar nhé</h4>
                        </div>
                        <div class="modal-body">
                            <input type="file" id="avatar_new" name="avatar_new">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="uploadAvatar" id="new-avatar">Save
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
</body>