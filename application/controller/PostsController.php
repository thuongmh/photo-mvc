<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/29/2016
 * Time: 3:46 PM
 */

namespace App\Controller;

use App\Model\Posts;

use App\Libs\uploadLib\Uploader;

use App\Libs\Helper;

class PostsController
{

    public function getcomments()
    {
        $post = new Posts();
        if (isset($_GET["action"]) && $_GET["action"] == "getcomments") {
//            echo "dkm dduowjc chuwa";exit();
            $isAlbum = $_GET["is_album"];
            $objId = $_GET["obj_id"];
//            echo $objId;exit();
            $comments = $post->getCommentPost($isAlbum, $objId);
//            echo var_dump($comments);exit();
            $result = array();
            foreach ($comments as $item) {
                $reply = $post->getReply($isAlbum, $item["obj_id"], $item["comment_id"]);
                $child = array(
                    "content" => $item,
                    "child" => $reply
                );
                array_push($result, $child);
            }
            die(json_encode($result));
        }
    }
    public function create()
    {
        $post = new Posts();
        if (isset($_POST["action"]) && $_POST["action"] == "create") {
            $album = $_POST["data"];


            if (sizeof($album) == 1) {
                $contentType = "single";
            } else {
                $contentType = "multi";
            }

            $userId = $_SESSION["user_id"];
            $lastAlbumId = $post->createAlbum($contentType, $userId);
            echo $lastAlbumId;
            $_SESSION["album_id"] = $lastAlbumId;
            for ($i = 0; $i < sizeof($album); $i++) {
                $lastImageId = $post->createImage("images/albums/" . $album[$i], $lastAlbumId);
            }
        }
    }

    public function edit($albumId)
    {
        $post = new Posts();
        $albumId = $_SESSION["album_id"];
        $allAlbumImage = $post->getAlbumImage($albumId);
        if (isset($_REQUEST["btn-edit"])) {
            $albumCaption = $_REQUEST["caption-album-edit"];
            $editAlbum = $post->editAlbum($albumId, $albumCaption);
            $tags = $_REQUEST["tag-album-edit"];
            $tags = explode(",", $tags);
            for ($i = 0; $i < sizeof($tags); $i++) {
                if ($post->checkTags($tags[$i]) == 0) {
                    $post->createTag($tags[$i]);
                }
            }
            foreach ($allAlbumImage as $image) {
                $imageCaption = $_REQUEST["caption-image-edit-" . $image["image_id"]];
                $editImage = $post->editImage($albumId, $image["image_id"], $imageCaption);
                if ($editAlbum && $editImage) {
                    header("Location:/home");
                } else {
                    Helper::setError("system", "Sai ở đâu rồi!");
                }
            }
        }
        require APP . "view/home/header.php";
        require APP . "view/home/edit.php";
    }

//    chi xu ly upload thoi. ke cmm
    public function upload()
    {
        $uploader = new Uploader();
        $data = $uploader->upload($_FILES['files'], array(
            'limit' => 10, //Maximum Limit of files. {null, Number}
            'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
            'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
            'required' => false, //Minimum one file is required for upload {Boolean}
            'uploadDir' => '../public/images/albums/', //Upload directory {String}
            'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
            'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
            'replace' => false, //Replace the file if it already exists  {Boolean}
            'perms' => null, //Uploaded file permisions {null, Number}
            'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
            'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
            'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
            'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
            'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
            'onRemove' => null //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
        ));

        if ($data['isComplete']) {
            $files = $data['data'];
            echo json_encode($files['metas'][0]['name']);
        }

        if ($data['hasErrors']) {
            $errors = $data['errors'];
            echo json_encode($errors);
        }

        // xu ly them vao csdl


        exit;
    }

    public function remove()
    {
        if (isset($_POST['file'])) {
            $file = '../public/images/albums/' . $_POST['file'];
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }

    public function updatelike()
    {
        $post = new Posts();
        if (isset($_POST["action"]) && $_POST["action"] == "updatelike") {
            $isAlbum = $_POST["is_album"];
            $objId = $_POST["obj_id"];
            $userId = $_SESSION["user_id"];
            $statusLike = $post->statusLikeAlbum($objId, $userId);
            if ($statusLike == 0) {
                $countLike = $post->likeAlbum($isAlbum, $objId, $userId);
                echo $countLike;
            } else {
                $updateLike = $post->updateLikeAlbum(!$statusLike["active"], $userId, $objId);
                die($updateLike);
            }
        }
    }

    public function checkLike ()
    {
        $post = new Posts();
        if (isset($_POST["action"]) == "check_like")
        {
            $obj_id = $_POST["obj_id"];
            $isAlbum = $_POST["is_album"];
            $userId = $_SESSION["user_id"];
            $checkLike = $post->checkLike($obj_id, $isAlbum, $userId);
            die($checkLike);
        }
    }


    public function comment()
    {
        $post = new Posts();
        if (isset($_POST["action"]) && $_POST["action"] == "comment") {
            $replyTo = $_POST["reply_to"];
            $comment = $_POST["comment"];
            $isAlbum = $_POST["is_album"];
            $objId = $_POST["obj_id"];
            $userId = $_SESSION["user_id"];
            $lastCommentId = $post->createCommentPost($replyTo, $comment, $isAlbum, $objId, $userId);
//            die($lastCommentId);
            $comment = $post->getCommentById($lastCommentId);
            die(json_encode($comment));
        }
    }

}