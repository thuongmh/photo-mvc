<?php
namespace App\Controller;

use App\Model\Home;

class HomeController
{
    public function index()
    {
        if (isset($_SESSION["login"]) && $_SESSION["login"] == 1) {
            require APP . "view/home/header.php";
            require APP . "view/home/home.php";
        } else {
            header("Location:" . URL);
        }
    }

    public function test()
    {
        if (isset($_POST['action']) && $_POST['action'] == 'load') {
            $page = $_POST['page'];
            $stt = ($page - 1) * 4;
            $album_all = array();
            $images = array();
            $like = array();
            $images_single = array();
            $home = new Home();
            $id_album = $home->getIdAlbum($stt);
            $image_id = array();
            $image_id_single = array();

//          get like
            $userId = $_SESSION["user_id"];

            foreach ($id_album as $id) {

                $getLike = $home->getLikeByUserId($userId, $id['album_id']);
                array_push($like, $getLike);

//              check multi & single adbum
                $check_album = $home->checkAbum($id['album_id']);

//              get Avatar
                $getAvatar = $home->getAvatar($id['user_id']);

//              get Album ID
                array_push($getAvatar, $id['album_id']);

//              get photo avatar
                $getPhotoAvatar = $home->getImageAvatar($id['user_id']);

//              get caption album
                $getcaption = $home->getCaption($id['album_id']);

//              get tag album
                $getTagAlbum = $home->getTagAlbum($id['album_id']);

                if ($check_album['content_type'] == "multi") {
                    $post_multi = $home->getPostId($id['album_id']);

                    foreach ($post_multi as $multi) {
                        array_push($images, $multi['link']);
                        array_push($image_id, $multi['image_id']);
                    }
                    $album_multi = array(

                        "images" => $images,
                        "avatar" => $getAvatar,
                        "caption" => $getcaption,
                        "photo_ava" => $getPhotoAvatar,
                        "tag" => $getTagAlbum,
                        "like" => $getLike,
                        "image_id"=> $image_id
                    );
                    array_push($album_all, $album_multi);
                } else {
                    $post_single = $home->getPostId_single($id['album_id']);
                    array_push($images_single, $post_single['link']);
                    array_push($image_id_single,$post_single['image_id']);
                    $album_single = array(
                        "images" => $images_single,
                        "avatar" => $getAvatar,
                        "caption" => $getcaption,
                        "photo_ava" => $getPhotoAvatar,
                        "tag" => $getTagAlbum,
                        "like" => $getLike,
                        "image_id" => $image_id_single
                    );
                    array_push($album_all, $album_single);

                }
                // gán lại thành các mảng rỗng
                $images_single = array();
                $images = array();
                $image_id = array();
                $image_id_single = array();

            }
//            echo var_dump($album_all);
            die(json_encode($album_all));
        }
//
    }
    public function image () {
        $home = new Home();
        if (isset($_POST['action'])== "zoom_image"){
            $image_id = $_POST['image_id'];
            $userId = $_SESSION['user_id'];
            $getImage = $home->getImage($image_id);
            $viewUpdate = $getImage['view'] + 1;
            $home->updateView($viewUpdate, $image_id);
            $getLikeImage = $home->getLikeImageByUserId($userId, $image_id);
            $getImage["like"] = $getLikeImage;
//            var_dump($getImage);exit();
            die(json_encode($getImage));
        }
        else {
            echo "tạch rồi";
        }
    }
    public function imageNext () {
        $home = new Home();
        if (isset($_POST['action']) == "next_image"){
            $image_id = $_POST['image_id'];
            $album_id = $_POST['album_id'];
            $id_next = $home->getNextImage($album_id,$image_id);
            $getImage = $home->getImage($id_next['image_id']);
            $image_id_new = $getImage['image_id'];
            $viewUpdate = $getImage['view'] + 1;
            $home->updateView($viewUpdate,  $image_id_new);
            die(json_encode($getImage));
        }else {
            echo "chưa gửi đươc";
        }
    }
    public function imageBack () {
        $home = new Home();
        if (isset($_POST['action']) == "back_image") {
            $image_id = $_POST['image_id'];
            $album_id = $_POST['album_id'];
            $id_back = $home->getBackImage($album_id, $image_id);
            $getImage = $home->getImage($id_back['image_id']);
            $image_id_new = $getImage['image_id'];
            $viewUpdate = $getImage['view'] + 1;
            $home->updateView($viewUpdate,  $image_id_new);
            die(json_encode($getImage));
        }
    }
    public function loadId () {
        $home = new Home();
        if (isset($_POST['action']) == "load_all_id"){
            $rowcout = count($home->getAllId());
            die(json_encode($rowcout));
//            echo "thành công rồi nhé";
        }else {
            echo "tạch rồi nhé";
        }
    }
    public function homeUser($id) {
        \App\Libs\Helper::loadView('homeUser',
            [
                'nghia' => $id
            ]);
    }
    public function getIdUser () {
        $home = new Home();
        if (isset($_POST['action']) == "load_all_id") {
            $user_id = $_POST['user_id'];
//            echo $user_id;exit();
            $rowcout = count($home->getAllIdUser($user_id));
            die(json_encode($rowcout));
        }
    }
    public function getHomeUser () {
        $home = new Home();
        $page = $_POST['page'];
        $stt = ($page - 1)* 3;
        $album_all = array();
        $images = array();
        $images_single = array();
        $images_id = array();
        $images_id_single = array();
        if (isset($_POST['action']) == "load_view_ưser") {
            $user_id = $_POST['user_id'];
            $album_id = $home->loadUser($user_id, $stt);

            foreach ($album_id as $id) {
//            get thông tin tài khoản
                $getAvatar = $home->getAvatar($user_id);
//            get caption album
                $getcaption = $home->getCaption($id['album_id']);
//            get tag album
                $getTagAlbum = $home->getTagAlbum($id['album_id']);
                $check_album = $home->checkAbum($id['album_id']);
                if ($check_album['content_type'] == "multi") {
                    $post_multi = $home->getPostId($id['album_id']);
                    foreach ($post_multi as $multi) {
                        array_push($images, $multi['link']);
                        array_push($images_id, $multi['image_id']);
                    }
                    $album_multi = array(
                        "image_id" => $images_id,
                        "images" => $images,
                        "caption" => $getcaption,
                        "tag" => $getTagAlbum,

                    );
                    array_push($album_all, $album_multi);
                } else {
                    $post_single = $home->getPostId_single($id['album_id']);
                    array_push($images_single, $post_single['link']);
                    array_push($images_id_single, $post_single['image_id']);
                    $album_single = array(
                        "image_id" => $images_id_single,
                        "images" => $images_single,
                        "caption" => $getcaption,
                        "tag" => $getTagAlbum
                    );
                    array_push($album_all, $album_single);
                    $images_single = array();
                    $images = array();
                    $images_id_single = array();
                    $images_id = array();
                }
            }
            die(json_encode($album_all));
        }
    }

    public function getPageUser()
    {
        $home = new Home();
        $user_id = $_POST['user_id'];
        if (isset($_POST['action']) && $_POST['action'] == "getPageUser") {
            $getAvatar = $home->getAvatar($user_id);
            echo $getAvatar;
        } else {
            echo "tạch rồi nhé";
        }

    }
//   xử lý load cột giới thiệu kêt bạn bên phải
    public function getUserHot ()
    {
        $home = new Home();
        if(isset($_POST['action']) == "loadDataRight")
        {
            $getUserHot = $home->getUserHot();
            die(json_encode($getUserHot));
        }
        else
        {
            echo "tạch con mẹ nó rồi";
        }
    }
    // hàm này để lấy user và cái ảnh nhiều view nhất ra
    public function getUserOne ()
    {
        $home = new Home();
        if(isset($_POST['action']) == "loadDataOne")
        {
            $getImageOne = $home->getImageOne();
            die(json_encode($getImageOne));
        }
        else
        {
            echo "tach con mẹ nó rồi";
        }
    }
    // chuyển sang trang profile

}

