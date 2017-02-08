<section class="container section">
    <div class="section-left">
        <ul id="content">
            <li class="menu-section wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.3s">
                <a class="avatar-you">
                    <img class="img-responsive" src="<?php echo $_SESSION["avatar"] ?>">
                    <input type="hidden" value="<?php echo  $_SESSION["fullname"] ?>" id="username">
                </a>
                <a class="menu-item"><i class="fa fa-text-height fa-3x" style="color: #4d4d4d;"></i><span>Text</span></a>
                <a data-toggle="modal" href='#upload-image' style="text-decoration: none;" class="menu-item"><i class="fa fa-camera  fa-3x" style="color: #ff5050;"></i><span>Photo</span></a>
                <a class="menu-item"><i class="fa fa-quote-left  fa-3x" style="color: #ff9900;"></i><span>Caption</span></a>
                <a class="menu-item"><i class="fa fa-file-text  fa-3x" style="color: #33cc33;"></i><span>Text</span></a>
                <a class="menu-item"><i class="fa fa-volume-down  fa-3x" style="color: #cc00ff;"></i><span>Audio</span></a>
                <a class="menu-item"><i class="fa fa-video-camera  fa-3x" style="color: #999966;"></i><span>Video</span></a>
            </li>
        </ul>
    </div>
    <div class="section-right">
        <div class="add_blog_0">
            <div class="title-column">
                <h4>Gợi ý kết bạn</h4>
            </div>
            <ul class="add_blog" id="follow-user">
<!--                <li>-->
<!--                    <div class="row" style="display:block">-->
<!--                        <div class="col-md-12">-->
<!--                            <div class="col-sm-2">-->
<!--                                <img src="images/demo-avatar.jpg" class="img-responsive">-->
<!--                            </div>-->
<!--                            <div class="col-sm-8">-->
<!--                                <div class="content-f">-->
<!--                                    <p>the mini fashion blog</p>-->
<!--                                    <i>The mini</i>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="blog_add col-sm-2">-->
<!--                                <a><span class="fa fa-plus-square fa-2x "></span></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </li>-->
            </ul>
        </div>
        <div class="add_fn">
            <div class="add_blog_0">
                <div class="title-column">
                    <h4>Bố éo biết </h4>
                </div>
                <ul class="add_blog" id="image_one">

                </ul>
            </div>
        </div>
    </div>
    <div class="hidden-left wow fadeInLeft" data-wow-delay="0.1s">
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
                                            <a id="username_modal" style="color: black">Trinh Thị Xuân Cường</a>
                                            <p id="created_at_modal">chỗ này để created_at</p>
                                        </div>
                                    </div>
                                    <p id="title_modal">title sẽ hiện ở đây</p>
                                    <p id="caption_modal">caption sẽ hiện ở đây</p>
                                </div>
                                <div class="icon_show_image clearfix">
                                    <a><i class="fa fa-location-arrow fa-lg"></i></a>
                                    <a><i class="fa fa-exchange fa-lg"></i></a>
                                    <a href="javascript:void(0)" class="like-image"><i class="fa fa-heart fa-lg"></i></a>
                                </div>
                                <div class="comment_show_image">
<!--                                    <div class="media">-->
<!--                                        <div class="media-left">-->
<!--                                            <a href="#">-->
<!--                                                <img src="/images/albums/avatar_demo.jpg" alt="" class=" media-object">-->
<!--                                            </a>-->
<!--                                        </div>-->
<!--                                        <div class="media-body ">-->
<!--                                            <a>Trịnh Xuân Thanh</a>-->
<!--                                            <p>tao thử xem là có được không thôi</p>-->
<!--                                        </div>-->
<!--                                    </div>-->
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

<style>

    #css-loader {
        display: none;
    }

    #fountainG{
        position:relative;
        width:234px;
        height:28px;
        margin:auto;
    }

    .fountainG{
        position:absolute;
        top:0;
        background-color:rgb(0,0,0);
        width:28px;
        height:28px;
        animation-name:bounce_fountainG;
        -o-animation-name:bounce_fountainG;
        -ms-animation-name:bounce_fountainG;
        -webkit-animation-name:bounce_fountainG;
        -moz-animation-name:bounce_fountainG;
        animation-duration:1.5s;
        -o-animation-duration:1.5s;
        -ms-animation-duration:1.5s;
        -webkit-animation-duration:1.5s;
        -moz-animation-duration:1.5s;
        animation-iteration-count:infinite;
        -o-animation-iteration-count:infinite;
        -ms-animation-iteration-count:infinite;
        -webkit-animation-iteration-count:infinite;
        -moz-animation-iteration-count:infinite;
        animation-direction:normal;
        -o-animation-direction:normal;
        -ms-animation-direction:normal;
        -webkit-animation-direction:normal;
        -moz-animation-direction:normal;
        transform:scale(.3);
        -o-transform:scale(.3);
        -ms-transform:scale(.3);
        -webkit-transform:scale(.3);
        -moz-transform:scale(.3);
        border-radius:19px;
        -o-border-radius:19px;
        -ms-border-radius:19px;
        -webkit-border-radius:19px;
        -moz-border-radius:19px;
    }

    #fountainG_1{
        left:0;
        animation-delay:0.6s;
        -o-animation-delay:0.6s;
        -ms-animation-delay:0.6s;
        -webkit-animation-delay:0.6s;
        -moz-animation-delay:0.6s;
    }

    #fountainG_2{
        left:29px;
        animation-delay:0.75s;
        -o-animation-delay:0.75s;
        -ms-animation-delay:0.75s;
        -webkit-animation-delay:0.75s;
        -moz-animation-delay:0.75s;
    }

    #fountainG_3{
        left:58px;
        animation-delay:0.9s;
        -o-animation-delay:0.9s;
        -ms-animation-delay:0.9s;
        -webkit-animation-delay:0.9s;
        -moz-animation-delay:0.9s;
    }

    #fountainG_4{
        left:88px;
        animation-delay:1.05s;
        -o-animation-delay:1.05s;
        -ms-animation-delay:1.05s;
        -webkit-animation-delay:1.05s;
        -moz-animation-delay:1.05s;
    }

    #fountainG_5{
        left:117px;
        animation-delay:1.2s;
        -o-animation-delay:1.2s;
        -ms-animation-delay:1.2s;
        -webkit-animation-delay:1.2s;
        -moz-animation-delay:1.2s;
    }

    #fountainG_6{
        left:146px;
        animation-delay:1.35s;
        -o-animation-delay:1.35s;
        -ms-animation-delay:1.35s;
        -webkit-animation-delay:1.35s;
        -moz-animation-delay:1.35s;
    }

    #fountainG_7{
        left:175px;
        animation-delay:1.5s;
        -o-animation-delay:1.5s;
        -ms-animation-delay:1.5s;
        -webkit-animation-delay:1.5s;
        -moz-animation-delay:1.5s;
    }

    #fountainG_8{
        left:205px;
        animation-delay:1.64s;
        -o-animation-delay:1.64s;
        -ms-animation-delay:1.64s;
        -webkit-animation-delay:1.64s;
        -moz-animation-delay:1.64s;
    }



    @keyframes bounce_fountainG{
        0%{
            transform:scale(1);
            background-color:rgb(0,0,0);
        }

        100%{
            transform:scale(.3);
            background-color:rgb(255,255,255);
        }
    }

    @-o-keyframes bounce_fountainG{
        0%{
            -o-transform:scale(1);
            background-color:rgb(0,0,0);
        }

        100%{
            -o-transform:scale(.3);
            background-color:rgb(255,255,255);
        }
    }

    @-ms-keyframes bounce_fountainG{
        0%{
            -ms-transform:scale(1);
            background-color:rgb(0,0,0);
        }

        100%{
            -ms-transform:scale(.3);
            background-color:rgb(255,255,255);
        }
    }

    @-webkit-keyframes bounce_fountainG{
        0%{
            -webkit-transform:scale(1);
            background-color:rgb(0,0,0);
        }

        100%{
            -webkit-transform:scale(.3);
            background-color:rgb(255,255,255);
        }
    }

    @-moz-keyframes bounce_fountainG{
        0%{
            -moz-transform:scale(1);
            background-color:rgb(0,0,0);
        }

        100%{
            -moz-transform:scale(.3);
            background-color:rgb(255,255,255);
        }
    }
</style>


</body>
</html>