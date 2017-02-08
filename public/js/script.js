// mang luu ket qua upload
var image = [];
var page = 1;
var is_busy = false;
var imgModalId;
var rowcout;
// muc dich cua cai ham nay la de tra ve 1 cai doan string ma no chua nhung thang child
function bindChild(array) {
    var html = '<ul>';

    array.forEach(function (item) {
        html += '<li> <div class="row"> <div class="cm-ava col-sm-2 col-md-2">' +
            '<img src="' + item.avatar + '" class="img-responsive"></div> ' +
            '<div class="cm-fullname col-sm-2 col-md-2" style="padding: 15px 0"> <a href="" style="color: #0D47A1">' + item.fullname + '</a> </div>' +
            '<div class="cm-detail col-sm-6 col-md-6" style="padding: 15px 0">' + item.comment + '</div> </div> </li>';
    });


    return html + '</ul>';
}

function bindComment(data) {
    console.log(data);
    if (data.length > 0) {
        var avatarUser = $(".avatar-you img").attr("src");

        var result = '<ul>';
        data.forEach(function (comment) {

            var html = '<li data-id="' + comment.content.comment_id + '"><div class="row"> <div class="cm-ava col-sm-2 col-md-2">' +
                '<img src="' + comment.content.avatar + '" class="img-responsive"></div> ' + '<div class="cm-fullname col-sm-2 col-md-2" style="padding: 15px 0"> <a href="" style="color: #0D47A1">' + comment.content.fullname + '</a> </div>' +
                '<div class="cm-detail col-sm-7 col-md-7" data-id="' + comment.content.user_id + '" style="padding: 15px 0">' + comment.content.comment + '<div class="cm-icon"> ' +
                '<span style="cursor: pointer; float: right" class="reply-comment-album"><i class="fa fa-exchange fa-lg"></i> </span> </div>' +
                '<div class="text-cm-reply" data-id="' + comment.content.obj_id + '"><textarea name="" id="text-reply-' + comment.content.comment_id + '" class="form-control" rows="2" required="required" placeholder="Write Comment"></textarea>' +
                '<button type="submit" class="btn btn-primary btn-reply-cm">Send</button></div></div><div class="clearfix"></div>  </div>' +
                bindChild(comment.child) +
                ' </li>';

            result += html;
        });

        result += "</ul>";

        var textarea = '<div class="row"> <div class="cm-ava col-sm-2 col-md-2"><img src="' + avatarUser + '" class="img-responsive"></div>' +
            ' <div class="cm-detail col-sm-10 col-md-10"> <textarea data-id="' + data[0].content.obj_id + '" id="text-comment-' + data[0].content.obj_id + '" class="form-control" rows="2" required="required" placeholder="Write Comment"></textarea> ' +
            '<button type="submit" class="btn btn-primary btn-send-cm">Send</button><small> Nhấn send để gửi</small> </div> </div>';

        result += textarea;
    } else {
        var result = '<div class="row"> <div class="cm-ava col-sm-2 col-md-2"><img src="' + avatarUser + '" class="img-responsive"></div>' +
            ' <div class="cm-detail col-sm-10 col-md-10"> <textarea data-id="' + data[0].avatar.obj_id + '" id="text-comment-' + data[0].avatar.obj_id + '" class="form-control" rows="2" required="required" placeholder="Write Comment"></textarea> ' +
            '<button type="submit" class="btn btn-primary btn-send-cm">Send</button><small> Nhấn send để gửi</small> </div> </div>';
        ;
    }


    return result;
}

$(document).ready(function () {
    // lấy tổng số trang
    loadId();
    // Login Form
    $("#loginContainer").click(function () {
        $("#loginBox").toggle();
        $("#show-login").toggleClass("active");
    });

    $("#submit-reset").click(function () {
        var email_reset = $("#email-reset").val();
        $.ajax({
            method: "POST",
            url: "/users/reset",
            data: {
                action: "reset",
                email_reset: email_reset
            },
            success: function (data) {
                data = $.parseJSON(data);
                $("#notication").text(data.message);
            },
            beforeSend: function () {
                $('body').append('<div id="over">');
                $('#over').fadeIn(300);
                $("#circularG").css("display", "block");
            },
            complete: function () {
                $('#over').fadeOut(300, function () {
                    $('#over').remove();
                });
                $('#circularG').css('display', 'none');
            }
        })
    })
    // update prifile

    // Phân trang

    if (page == 1) {
        loadData();
        // cái này load cục bên phải
        loadDataRight();
    }
    likeAlbum();
    likeImage();
    loadCommentsAlbum();
    showImage();
    getNextImg();
    getBackImage();
    load_user();
    uploadProfile();
    showReplyCommentsImage();
    sendCommentImage();
    replyCommentImage();

    // trang cá nhân

    // Hàm này để gửi comment

    $("#btn-create").click(function () {
        $.ajax({
            method: "POST",
            url: "/posts/create",
            data: {
                action: "create",
                data: image
            },
            success: function (data) {
                console.log(data);
                window.location = "/posts/edit/" + data;
            },
            complete: function () {
                image = [];
            }
        })
    });


    // load data
    // scroll chuột
    $(window).scroll(function () {
        $element = $('#content');
        if ($(window).scrollTop() + $(window).height() >= $element.height()) {
            // nếu đang gửi ajax thì ngưng không gửi nữa
            if (is_busy == true) {
                return false;
            } else {
                if (page <= rowcout) {
                    is_busy = true;
                    loadData()
                }
            }

        }
    });
});
    function loadData(data) {
        $.ajax({
            method: "POST",
            url: "/home/test",
            data: {
                action: "load",
                page: page
            },
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                var html = "";
                var photo_ava = "";
                var photo_album = "";
                var hidden_right_menu = "";
                var photo_album_user = "";
                var tag = "";
                var co = 0;
                // console.log(data.length);
                for (var i = 0; i < data.length; i++) {
                    for (var b = 0; b < data[i].photo_ava.length; b++) {
                        photo_album_user += '<div class="section-user-conten-item"> <div class="post-title"> <p>' + data[i].photo_ava[b].title + '</p> </div>' +
                            ' <div class="post-photo-1"> <img src="' + data[i].photo_ava[b].link + '" class="img-responsive"> </div> ' +
                            '<div class="post-icon clearfix"> <div class="caption_user"> <span>' + data[i].photo_ava[b].caption + '</span> </div> ' +
                            '<div class="view-post">View: 248</div> <div class="icon"> <a><i class="fa fa-heart-o fa-lg"></i></a> ' +
                            '<a><i class="fa fa-eavatar-userxchange fa-lg"></i></a> <a><i class="fa fa-location-arrow fa-lg"></i></a> </div> </div> </div>'
                    }
                    //lấy user - page
                    hidden_right_menu += '<div class="hidden-right-menu wow fadeInRight" data-wow-delay="0.1s"> <div class="header-user"> <div class="menu-header-user"> ' +
                        '<div class="banner-user"> <img src="images/banner_user.jpg" alt="" class="img-responsive"> </div> <div class="menu-user"> ' +
                        '<div class="name-user"> <span>' + data[i].avatar.username + '</span> </div> <div class="menu-user-right"> <ul> <li> <a href="/home/homeUser/' + data[i].avatar.user_id + '" class="btn btn-primary">Follow</a> </li> ' +
                        '<li> <a href=""><i class="fa fa-user fa-lg"></i></a> </li> <li> <a href=""><i class="fa fa-plus-circle fa-lg"></i></a> </li> ' +
                        '<li> <a href=""><i class="fa fa-share fa-lg"></i></a> </li> <li> <a href=""><i class="fa fa-search fa-lg"></i></a> </li> </ul> </div> </div> ' +
                        '<div class="avatar-user"> <img src="images/avatar_demo.jpg" class="img-responsive " alt=""> </div> </div> <div class="section-user"> ' +
                        '<p class="text-center">' + data[i].avatar.fullname + '</p>' + photo_album_user + '</div></div></div>';
                    //in header;
                    var header = '<li class="section-item"> <div class="avatar-post">' + hidden_right_menu + '<a class="avatar-img"> ' +
                        '<img class="img-responsive img_post" src="' + data[i].avatar.avatar + '"></a>' +
                        '<div class="modal-profile-boder"> <div class="modal-profile wow fadeInDown animated" data-wow-delay="0.5"> ' +
                        '<div class="user_name"> <a>' + data[i].avatar.username + '</a><p><span class="fa fa-user" style="color: white"></span> follow</p></div> ' +
                        '<div class="user-content"> <img src="' + data[i].avatar.avatar + '" class="img-responsive" style="width: 70px; height: 70px"> ' +
                        '<h4>' + data[i].avatar.fullname + '</h4></div>';
                    for (var j = 0; j < data[i].photo_ava.length; j++) {
                        photo_ava += '<div class="col-sm-4"><img class="img-responsive" src="' + data[i].photo_ava[j].link + '"></div> '
                    }
                    var avatar_photo = '<div class="img_user"> <div class="co-sm-12"> ' + photo_ava + '</div><div class="clearfix"></div></div></div></div></div>';
                    console.log(data[i].images.length);
                    for (var a = 0; a < data[i].images.length; a++) {
                        photo_album += '<div class="post-photo"> <a><input type="hidden" value="' + data[i].image_id[a] + '"><img src="/' + data[i].images[a] + '" alt="" class="img-responsive show_image"> </a> </div>'
                    }
                    for (var j = 0; j < data[i].tag.length; j++) {
                        tag += ' <a>#' + data[i].tag[j].tag_name + '</a>';
                    }
                    // console.log(data[i].tag);
                    var footer = '<div class="post-footer"> <div class="check-in"> ' +
                        '<p>' + data[i].avatar.username + '</p> <p>' + data[i].caption.created_at + '</p> <p>' + data[i].caption.caption + '</p> </div> ' +
                        '<div class="post-tag">' + tag + '</div> ' +
                        '<div class="post-icon clearfix"> <div class="view-post">248</div> ';
                    if (data[i].like.length > 0 && data[i].like[0].active == 1 && data[i].like[0].is_album == 1 && data[i].avatar[0] == data[i].like[0].obj_id) {
                        footer += '<div class="icon"> <a href="javascript:void(0)" class="like-album liked"><i class="fa fa-heart fa-lg"></i><input type="hidden" id="album_id_sl" value="' + data[i].avatar[0] + '"></a> ' +
                            '<a href="javascript:void(0)" class="comment-album"><i class="fa fa-exchange fa-lg"></i><input type="hidden" id="album_id_sl" value="' + data[i].avatar[0] + '"></a> ' +
                            '<a><i class="fa fa-location-arrow fa-lg"></i></a> </div> </div> </div> </li>';
                    } else {
                        footer += '<div class="icon"> <a href="javascript:void(0)" class="like-album"><i class="fa fa-heart fa-lg"></i><input type="hidden" id="album_id_sl" value="' + data[i].avatar[0] + '"></a> ' +
                            '<a href="javascript:void(0)" class="comment-album"><i class="fa fa-exchange fa-lg"></i><input type="hidden" id="album_id_sl" value="' + data[i].avatar[0] + '"></a> ' +
                            '<a><i class="fa fa-location-arrow fa-lg"></i></a> </div> </div> </div> </li>';
                    }
                    var comment = '<div class="post-comment post-comment-' + data[i].avatar[0] + '" > <ul data-id="' + data[i].avatar[0] + '"> </ul> </div>';
                    html += header + avatar_photo + '<div class="post-title">' + data[i].caption.content + '</div>' + photo_album + footer + comment;
                    photo_ava = "";
                    photo_album = "";
                    tag = "";
                    photo_album_user = "";
                    hidden_right_menu = "";
                }
                $("#content").append(html);
            },
            complete: function () {
                loadJquery();
                page++;
                console.log("bây giờ page = " + page);
                is_busy = false;
                // likeAlbum();

            }
        })
    }
    // hàm này sẽ load những cái bòi giới thiệu kêt bạn ở bên tay phải
    function loadDataRight () {
        $.ajax({
            method:"post",
            url: "/home/getUserHot",
            data: {
                action: "loadDataRight"
            },
            success:function (data) {
                data = JSON.parse(data);
                console.log(data);
                loadHtmlRight(data);
            }
        })
        $.ajax({
            method:"post",
            url: "/home/getUserOne",
            data: {
                action: "loadDataOne"
            },
            success:function (data) {
                data = JSON.parse(data);
                console.log(data);
                loadHtmlOneRight(data);
            }
        })
    }
// Cục này là đoạn HTML bên phải
    function loadHtmlRight(data)
    {
        var html = "";
        for (var i = 0; i < data.length; i++)
        {
            html += '<li> <div class="row" style="display:block"> <div class="col-md-12"> <div class="col-sm-2"> ' +
                '<img src="'+ data[i].avatar +'" class="img-responsive"> </div> <div class="col-sm-8"> ' +
                '<div class="content-f"> <p>'+ data[i].fullname +'</p> <i>'+ data[i].username +'</i> </div> </div> ' +
                '<div class="blog_add col-sm-2"> <a><span class="fa fa-plus-square fa-2x "></span></a> </div> </div> </div> </li>';
        }
        $("#follow-user").append(html);
    }
// cục này là đoạn html ảnh nhiều view nhất
    function loadHtmlOneRight (data) {
        var html = "";
        html = '<li> <div class="row" style="display:block; margin-bottom: 10px"> <div class="col-md-12"> <div class="col-sm-2"> ' +
            '<img src="'+ data.avatar +'" class="img-responsive"> </div> <div class="col-sm-8"> <div class="content-f"> ' +
            '<p>'+ data.fullname +'</p> <i>'+ data.username +'</i> </div> </div> <div class="blog_add col-sm-2"> <a><span class="fa fa-plus-square fa-2x "></span></a> ' +
            '</div> </div> </div> <div id="image-user-hot"> <img src="'+ data.link +'" class="img-responsive"> ' +
            '<div class="icon-image"> <a class="like-album"><i class="fa fa-heart fa-lg"></i></a> <span class="load-view">'+ data.view +'</span> </div> </div> </li>';
        $("#image_one").append(html)
    }
    function bindCommentInput(objId) {
        var avatarUser = $(".avatar-you img").attr("src");
        var result = "";
        result = '<ul><div class="row"> <div class="cm-ava col-sm-2 col-md-2"><img src="' + avatarUser + '" class="img-responsive"></div>' +
            ' <div class="cm-detail col-sm-10 col-md-10"> <textarea data-id="' + objId + '" id="text-comment-' + objId + '" class="form-control" rows="2" required="required" placeholder="Write Comment"></textarea> ' +
            '<button type="submit" class="btn btn-primary btn-send-cm">Send</button><small> Nhấn send để gửi</small> </div> </div></ul>';
        return result;
    }
    function bindComment(data) {
        console.log(data);
        var avatarUser = $(".avatar-you img").attr("src");

        var result = '<ul>';
        data.forEach(function (comment) {

            var html = '<li data-id="' + comment.content.comment_id + '"><div class="row" style="padding: 15px 0"> <div class="cm-ava col-sm-2 col-md-2">' +
                '<img src="' + comment.content.avatar + '" class="img-responsive"></div> ' + '<div class="cm-fullname col-sm-2 col-md-2" > <a href="" style="color: #0D47A1">' + comment.content.fullname + '</a> </div>' +
                '<div class="cm-detail col-sm-7 col-md-7" data-id="' + comment.content.user_id + '"><div class="col-sm-10 col-md-10" style="padding: 0px"><p>' + comment.content.comment + '</p></div><div class="cm-icon col-sm-2 col-md-2" style="padding: 0px"> ' +
                '<span style="cursor: pointer; float: right" class="reply-comment-album"><i class="fa fa-exchange fa-lg"></i> </span> </div>' +
                '<div class="text-cm-reply" style="margin-top: 80px; border-top: 1px solid #36465d; padding-top: 10px" data-id="' + comment.content.obj_id + '"><textarea name="" id="text-reply-' + comment.content.comment_id + '" class="form-control" rows="2" required="required" placeholder="Write Comment"></textarea>' +
                '<button type="submit" class="btn btn-primary btn-reply-cm">Send</button></div></div><div class="clearfix"></div>  </div>' +
                bindChild(comment.child) +
                ' </li>';

            result += html;
        });

        result += "</ul>";

        var textarea = '<div class="row" style="padding-left: 40px"> <div class="cm-ava col-sm-2 col-md-2"><img src="' + avatarUser + '" class="img-responsive"></div>' +
            ' <div class="cm-detail col-sm-10 col-md-10"> <textarea data-id="' + data[0].content.obj_id + '" id="text-comment-' + data[0].content.obj_id + '" class="form-control" rows="2" required="required" placeholder="Write Comment"></textarea> ' +
            '<button type="submit" class="btn btn-primary btn-send-cm">Send</button><small> Nhấn send để gửi</small> </div> </div>';

        result += textarea;

        return result;
    }
    function loadJquery() {
        $(".avatar-img").hover(function () {
            $(this).next().css("display", "block")
        }, function () {
            $(this).next().css("display", "none")
        });
        $(".modal-profile-boder").hover(function () {
            $(this).css("display", "block")
        }, function () {
            $(this).css("display", "none")
        });
        // hiện trang cá nhân ở trang chủ
        $(".avatar-img").click(function () {
            $(this).prev().css("display", "block");
            $(".hidden-left ").css("display", "block");
            $("body").addClass("peepr");
        });
        $(".hidden-left").click(function () {
            $(".hidden-left").css("display", "none");
            $(".hidden-right-menu").css("display", "none");
            $(".search-mobile-div ").css("display", "none");
            $("body").removeClass("peepr");
        });
        $(".hidden-right-menu").click(function () {
            $(".hidden-left").css("display", "none");
            $(".hidden-right-menu").css("display", "none");
            $("body").removeClass("peepr");
        });
        $("#search-mobile").click(function () {
            // alert("click được rồi nhé");
            $(".search-mobile-div ").css("display", "block");
            $(".hidden-left ").css("display", "block");
            $("body").addClass("peepr");
        });
        // lit pe like an bum

    }

    function loadCommentsAlbum() {
    $("#content").on('click', '.comment-album', function () {
        var objId = $(this).children().last().val();
        console.log(objId);
        $.ajax({
            method: "GET",
            url: "/posts/getcomments",
            data: {
                action: "getcomments",
                is_album: 1,
                obj_id: objId
            },
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                if (data.length == 0) {
                    $('.post-comment-' + objId).html('');
                    $(".post-comment-" + objId).append(bindCommentInput(objId));
                    $(".post-comment-" + objId).slideToggle();
                } else {
                    $('.post-comment-' + objId).html('');
                    $(".post-comment-" + objId).append(bindComment(data));
                    $(".post-comment-" + objId).slideToggle();
                }
            },
            complete: function () {
                sendComment();
                replyComment();
            }

        })
    })
}
// Hàm này để gửi comment

    function sendComment() {
        var username = $("#username").val();
        $(".btn-send-cm").click(function () {
            var commentEl = $(this).parent().children('textarea');
            var comment = commentEl.val();
            var objId = commentEl.data('id');
            var append = '';
            $.ajax({
                method: "POST",
                url: "/posts/comment",
                data: {
                    action: "comment",
                    reply_to: 0,
                    comment: comment,
                    is_album: 1,
                    obj_id: objId
                },
                success: function (data) {
                    data = JSON.parse(data);
                    console.log(data);

                    var newComment = '<li><div class="row" style="padding: 15px 0"> <div class="cm-ava col-sm-2 col-md-2">' +
                        '<img src="' + data.avatar + '" class="img-responsive"></div> ' + '<div class="cm-fullname col-sm-2 col-md-2" > <a href="" style="color: #0D47A1"><a href="" style="color: #0D47A1">' + username + '</a> </div>' +
                        '<div class="cm-detail col-sm-7 col-md-7">' + data.comment +
                        '<div class="cm-icon"> <span style="cursor: pointer; float: right" class="reply-comment-album"><i class="fa fa-exchange fa-lg"></i> </span> </div>' +
                        '</div> ' +
                        '</div></li>';
                    append += newComment;

                    $(".post-comment-" + data.obj_id + "> ul").append(append);
                    $("#text-comment-" + data.obj_id).val("");
                }
            })
        });
    }

// Trả lời comment

    function replyComment() {
        $(".reply-comment-album").click(function () {
            $(this).parent().next().toggleClass("show");
            $(".btn-reply-cm").click(function () {
                var username = $("#username").val();
                var replyTo = $(this).parent().parent().parent().parent().data("id");
                console.log(replyTo);
                var comment = $(this).prev().val();
                console.log(comment);
                var objId = $(this).parent().data("id");
                console.log(objId);
                $.ajax({
                    method: "POST",
                    url: "posts/comment",
                    data: {
                        action: "comment",
                        reply_to: replyTo,
                        comment: comment,
                        obj_id: objId
                    },
                    success: function (data) {
                        data = JSON.parse(data);
                        console.log(data);
                        var newReply = '<li style="padding: 10px 0px"> <div class="row"> <div class="cm-ava col-sm-2 col-md-2">' +
                            '<img src="' + data.avatar + '" class="img-responsive"></div>' + '<div class="cm-fullname col-sm-2 col-md-2" style="padding: 0px" > <a href="" style="color: #0D47A1"><a href="" style="color: #0D47A1">' + username + '</a> </div>' +
                            '<div class="cm-detail col-sm-7 col-md-7">' + data.comment + '</div> </div> </li>';
                        console.log(".post-comment-" + data.obj_id + "> ul > li[data-id='" + replyTo + "'] > ul");
                        $(".post-comment-" + data.obj_id + "> ul > li[data-id='" + replyTo + "'] > ul").append(newReply);
                        $("#text-reply-" + replyTo).val("");
                        $("#text-reply-" + replyTo).parent().toggleClass("show");
                    }
                })
            })
        })
    }
    function loadId() {
        $.ajax({
            method: "post",
            url: "/home/loadId",
            data: {
                action: "load_all_id"
            },
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                rowcout = Math.ceil(data / 4);
                console.log(rowcout);
                return rowcout;
            }
        })
    }

// load image
function loadImage(data) {
    // xóa class liked đã lưu trong modal
    $("#myModal").on('hidden.bs.modal', function (e) {
        $(".icon_show_image .like-image").removeClass("liked");
        $(".comment_show_image").html("");
    });
    $(".image_modal").attr("src", "/" + data.link);
    $(".avatar_modal").attr("src", "/" + data.avatar);
    $("#username_modal").html(data.username);
    $("#created_at_modal").html(data.created_at);
    $("#title_modal").html(data.title);
    $("#caption_modal").html(data.caption);
    $("#album_id_modal").attr("data-id", data.album_id);
    $("#album_id_modal").attr("data-id-im", data.image_id);
    if (Object.keys(data.like).length > 0 && data.like.active === '1') {
        $(".icon_show_image .like-image").addClass("liked");
    }
}
// show image
function showImage() {
        $("#content").on('click','.show_image',function () {
            var image_id = $(this).prev().val();
            console.log(image_id);
            $.ajax({
                method: "post",
                url: "/home/image",
                data: {
                    action: "zoom_image",
                    image_id: image_id
                },
                success: function (data) {
                    data = JSON.parse(data);
                    console.log(data);
                    // update imgModalId when click to image
                    imgModalId = data.image_id;
                    albumId = data.album_id;
                    // console.log('gan data luc open modal' + imgModalId);
                    loadImage(data);


                    $("#myModal").modal("show");
                },
                complete: function () {
                    // likeImage();
                    console.log("em xin anh" + imgModalId);
                    loadCommentsImage(image_id);
                }
            })
        });
    }
function getNextImg() {
        $("#myModal").on('click','#next_modal',function () {
            var album_id = $(this).parent().data("id");
            console.log('gui len nhe' + imgModalId);
            $.ajax({
                method: "post",
                url: "/home/imageNext",
                data: {
                    action: "next_image",
                    album_id: albumId,
                    image_id: imgModalId
                },
                success: function (data) {
                    data = JSON.parse(data);
                    console.log(data);

                    imgModalId = data.image_id;
                    albumId = data.album_id;
                    console.log("gan imgModalId luc bam next " + imgModalId);
                    loadImage(data);
                }
            })
        });
    }
function likeImage() {
    $("body").on('click', '.like-image', function () {
        $(this).toggleClass("liked");
        var objId = $(this).parent().parent().parent().prev().find("a").data("id-im");
        $.ajax({
            method: "POST",
            url: "/posts/updatelike",
            data: {
                action: "updatelike",
                is_album: 0,
                obj_id: objId
            },
            success: function (data) {

            }
        })
    })
}

function likeAlbum() {

        $("#content").on('click','.like-album', function () {
            $(this).toggleClass("liked");
            // like

            var objId = $(this).children().last().val();
            $.ajax({
                method: "POST",
                url: "/posts/updatelike",
                data: {
                    action: "updatelike",
                    is_album: 1,
                    obj_id: objId
                },
                success: function (data) {
                    console.log(data);

                }

            });
        });
    }
function getBackImage() {
        $("#myModal").on('click','#back_modal',function () {
            var album_id = $(this).parent().data("id");
            $.ajax({
                method: "post",
                url: "/home/imageBack",
                data: {
                    action: "back_image",
                    album_id: albumId,
                    image_id: imgModalId
                },
                success: function (data) {

                    data = JSON.parse(data);

                    imgModalId = data.image_id;
                    albumId = data.album_id;
                    // console.log("gan imgModalId luc bam next " + imgModalId);
                    loadImage(data);
                }
            })
        });
    }

function load_user() {
       $('.user').click(function () {
           $('#user-profile').slideToggle();
       })
   };
function uploadProfile () {
        var user_id = $("#user_id_dkm").val();
        $.fn.editable.defaults.mode = 'popup';
        $("#fullname").editable({
            type:"text",
            url: "/users",
            pk: user_id,
            name: "fullname_edit",
            title: "Fullname Edit",
            success:function (response, newValue) {
                console.log(newValue);
                if (response.status == 'error'){
                    return response.msg;
                    console.log(newValue);
                }
            }
        });
        $("#description").editable({
            type:"textarea",
            url: "/users",
            pk: user_id,
            name: "description_edit",
            title: "description Edit",
            success:function (response, newValue) {
                console.log(newValue);
                if (response.status == 'error'){
                    return response.msg;
                    console.log(newValue);
                }
            }
        })
    }
function loadCommentsImage(objId) {
    $.ajax({
        method: "GET",
        url: "/posts/getcomments",
        data: {
            action: "getcomments",
            is_album: 0,
            obj_id: objId
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.length == 0) {
                $(".comment_show_image ").append(bindCommentImageInput(objId))
            } else {
                $(".comment_show_image ").append(bindCommentsImage(data));
            }
            for (var i = 0; i < data.length; i++) {
                if (data[i].child.length > 0) {
                    showReplyCommentsImage(data[i].child[0].reply_to);
                }
            }
        },
        complete: function () {
            sendCommentImage();
        }
    })
}
function showReplyCommentsImage(replyTo) {
    $("#show-reply-" + replyTo).click(function () {
        $("#reply-" + replyTo).css("display", "block");
        $("#show-reply-" + replyTo).css("display", "none");
    })
};
function sendCommentImage() {
    $(".btn-send-cm-img").click(function () {
        var commentEl = $(this).parent().prev().children('textarea');
        var comment = commentEl.val();
        var objId = commentEl.data('id');
        $.ajax({
            method: "POST",
            url: "/posts/comment",
            data: {
                action: "comment",
                reply_to: 0,
                comment: comment,
                is_album: 0,
                obj_id: objId
            },
            success: function (data) {

                data = JSON.parse(data);
                console.log(data);
                var append = '<li><div class="media"> <div class="media-left">' +
                    ' <a href="#"> <img src="' + data.avatar + '" alt="" class="media-object"> ' +
                    '</a> </div> <div class="media-body"> <a>' + data.username + '</a>' +
                    ' <p>' + data.comment + ' <i class="fa fa-exchange fa-lg" id="reply-cm-img" style="float: right; cursor: pointer;"></i></p> </div> </div> ' +
                    '<a href="javascript:void(0)" style="padding-left: 30px; color: #0000ff;" id="show-reply-' + data.comment_id + '"></a></li>';
                $(".comment_show_image > ul").append(append);
            },
            complete: function () {
                commentEl.val("");
            }
        })
    })
};
function replyCommentImage() {
    $("#myModal").on("click", "#reply-cm-img", function () {
        // alert("aaaaaaaaaaa");
        $(this).closest("div").next().toggleClass("show");
    });


    $("#myModal").on('click', '.btn-reply-cm-img', function () {
        var commentEl = $(this).prev();
        var comment = commentEl.val();
        var objId = commentEl.parent().data("id");
        var replyTo = $(this).closest("li").data("id");
        $.ajax({
            method: "POST",
            url: "posts/comment",
            data: {
                action: "comment",
                reply_to: replyTo,
                is_album: 0,
                comment: comment,
                obj_id: objId
            },
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                var html = '<li><div class="media"> <div class="media-left">' +
                    ' <a href="#"> <img src="' + data.avatar + '" alt="" class="media-object"> ' +
                    '</a> </div> <div class="media-body"> <a>' + data.username + '</a>' +
                    ' <p>' + data.comment + '</p> </div> </div></li>';
                $(".comment_show_image > ul > li[data-id = '" + replyTo + "'] > ul").append(html);
            },
            complete: function () {
                commentEl.val("");
            }
        })
    });
};
function bindCommentsImage(data) {
    console.log(data);
    if (data.length > 0) {
        var result = "<ul style='padding-left: 0px;'>";
        data.forEach(function (comment) {
            var html = '<li data-id="' + comment.content.comment_id + '"><div class="media"> <div class="media-left">' +
                ' <a href="#"> <img src="' + comment.content.avatar + '" alt="" class="media-object"> ' +
                '</a> </div> <div class="media-body"> <a>' + comment.content.username + '</a>' +
                ' <p>' + comment.content.comment + ' <i class="fa fa-exchange fa-lg" id="reply-cm-img" style="float: right; cursor: pointer;"></i></p>  </div> <div class="text-cm-reply-img" data-id="' + comment.content.obj_id + '" style="margin-left:20px; margin-top: 10px">' +
                '<textarea name="" id="text-reply-' + comment.content.comment_id + '" class="form-control" rows="1" placeholder="Write Comment" style="margin-bottom: 10px;"></textarea>' +
                '<button type="submit" class="btn btn-primary btn-reply-cm-img">Send</button></div></div><div class="clearfix"></div>  </div> </div> ' +
                '<a href="javascript:void(0)" style="padding-left: 30px; color: #0000ff;" id="show-reply-' + comment.content.comment_id + '">' + countReply(comment.child) + '</a>' + bindChildsImage(comment.child) + '</li>';
            result += html;
        });
        result += "</ul>";

        var textarea = '<div class="comment-image"> <div class="row"> <div class="col-sm-8 col-md-8" style="padding-right: 0"> ' +
            '<textarea name="" id="text-reply-image" class="form-control" rows="1" placeholder="Write Comment" data-id="' + data[0].content.obj_id + '"></textarea> </div> ' +
            '<div class="col-sm-2 col-md-2" style="padding-right: 0"><button type="submit" class="btn btn-primary btn-send-cm-img">Send</button></div></div></div>';

        result += textarea;
    }
    return result;
}
function countReply(data) {
    if (data.length > 0) {
        return '<i class="fa fa-reply" aria-hidden="true"></i> ' + data.length + " bình luận";
    } else {
        return "";
    }
}

function bindChildsImage(data) {
    if (data.length > 0) {
        var result = '<ul style="display: none" id="reply-' + data[0].reply_to + '">';
        data.forEach(function (child) {
            var html = '<li><div class="media"> <div class="media-left">' +
                ' <a href="#"> <img src="' + child.avatar + '" alt="" class="media-object"> ' +
                '</a> </div> <div class="media-body"> <a>' + child.username + '</a>' +
                ' <p>' + child.comment + '</p> </div> </div></li>';
            result += html;
        });
        result += "</ul>";

    } else {
        result = "<ul></ul>";
    }
    // var textarea = '<div class="comment-image"> ' +
    //     '<textarea name="" id="text-reply-image" class="form-control" rows="1" placeholder="Write Comment"></textarea> ' +
    //     '</div>';
    // result += textarea;
    return result;
}
   // thay đổi thông tin
function bindCommentImageInput(objId) {
    var result = "";
    result = '<ul style="padding-left: 0px;"></ul><div class="comment-image"> <div class="row"> <div class="col-sm-8 col-md-8" style="padding-right: 0"> ' +
        '<textarea name="" id="text-reply-image" class="form-control" rows="1" placeholder="Write Comment" data-id="' + objId + '"></textarea> </div> ' +
        '<div class="col-sm-2 col-md-2" style="padding-right: 0"><button type="submit" class="btn btn-primary btn-send-cm-img">Send</button></div></div></div>';
    return result;
}
