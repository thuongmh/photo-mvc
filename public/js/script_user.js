/**
 * Created by Administrator on 11/01/2017.
 */
/**
 * Created by Administrator on 09/01/2017.
 */
var imgModalId = 1;
var page_user = 1;
$(document).ready(function () {
    loadIdUser();
    loadData_user();
    $(window).scroll(function () {
        $element = $('#content');
        if ($(window).scrollTop() + $(window).height() >= $element.height()) {


            // nếu số page nhỏ hơn số tổng số trang thì load tiếp
            console.log(rowcout);
            if (page_user <= rowcout) {
                // console.log('day la page luc scrooll' + page);
                loadData_user(page_user);
            }
        }
    });
});
function loadData_user () {
    var user_id = $("#user_id").val();
    $.ajax({
        method: "post",
        url: "/home/getHomeUser",
        data: {
            action: "load_view_ưser",
            user_id: user_id,
            page: page_user
        },
        success: function (data) {
            var html = "";
            var photo = "";
            var header = "";
            var footer = "";
            data = JSON.parse(data);
            console.log(data);
            for (var i = 0; i < data.length; i++) {
                header = '<li class="section-item"> <div class="post-title">'+ data[i].caption.content +'</div>';
                for (var j = 0; j < data[i].images.length; j++) {
                    photo += '<div class="post-photo"> <a><input type="hidden" value="'+ data[i].image_id[j]+'"><img src="/'+ data[i].images[j] + '" alt="" class="img-responsive show_image"> </a> </div>';
                }
                footer += '<div class="post-footer"> <div class="check-in"> <p></p> <p>created_at</p> <p>caption</p> </div> ' +
                    '<div class="post-tag"> <a>tagname</a> </div> <div class="post-icon clearfix"> <div class="view-post"> 248 </div> <div class="icon"> ' +
                    '<a><i class="fa fa-heart-o fa-lg"></i></a> <a><i class="fa fa-exchange fa-lg"></i></a> ' +
                    '<a><i class="fa fa-location-arrow fa-lg"></i></a> </div> </div> </div></li>';
                html += header + photo + footer;
                // console.log(photo);
                photo = "";
                header = "";
                footer = "";
            }
            $("#content").append(html);
        },
        complete: function () {
            page_user++;
            console.log("page hien tai bang" + page_user);
            showImage();
            getNextImg();
            loadJuery();
        }
    })
}
function loadImage(data) {
    $(".image_modal").attr("src", "/" + data.link);
    $(".avatar_modal").attr("src", "/" + data.avatar);
    $("#username_modal").html(data.username);
    $("#created_at_modal").html(data.created_at);
    $("#title_modal").html(data.title);
    $("#caption_modal").html(data.caption);
    $("#album_id_modal").attr("data-id", data.album_id);
    $("#album_id_modal").attr("data-id-im", data.image_id);
}
function loadJuery() {

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
    $(".avatar-img").click(function () {

        $(this).prev().css("display", "block");
        $(".hidden-left").css({"display": "block", "visibility": "visible"});
        $("body").toggleClass("peepr");
    });
    $(".hidden-left").click(function () {
        $(".hidden-left").css("display", "none");
        $(".hidden-right-menu").css("display", "none");
        $("body").toggleClass("peepr");
    });
}
function showImage() {
    $(".show_image").click(function () {
        var image_id = $(this).prev().val();
        // console.log(image_id);
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
                $("#back_modal").click(function () {
                    var album_id = $(this).parent().data("id");
                    // var image_id = imgModalId;
                    // console.log('gui len nhe' + imgModalId);
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

                $("#myModal").modal("show");
            },
            complete: function () {
                console.log("em xin anh" + imgModalId);
            }
        })
    });
}
function getNextImg() {
    $("#next_modal").click(function () {
        var album_id = $(this).parent().data("id");
        // var image_id = imgModalId;
        console.log(album_id);
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

                imgModalId = data.image_id;
                albumId = data.album_id;
                console.log("gan imgModalId luc bam next " + imgModalId);
                loadImage(data);
            }
        })
    });
}
function loadIdUser() {
    var user_id = $("#user_id").val();
    $.ajax({
        method: "POST",
        url: "/home/getIdUser",
        data: {
            action: "load_all_id",
            user_id: user_id
        },
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            rowcout = Math.ceil(data / 3);
            console.log(rowcout);
            return rowcout;
        }
    })
}