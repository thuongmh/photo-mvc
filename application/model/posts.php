<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/29/2016
 * Time: 3:47 PM
 */

namespace App\Model;

use App\Core\Controller;

use App\Libs\Algolia;
use PDO;

class Posts extends Controller
{
    public function getReply($isAlbum, $objId, $replyTo)
    {
        $sql = "SELECT comments.*, users.username, users.avatar, users.fullname FROM comments INNER JOIN users ON comments.user_id = users.user_id WHERE comments.is_album = :is_album AND comments.obj_id = :obj_id AND comments.reply_to = :reply_to ORDER BY comments.created_at ASC";
        try{
            $query = $this->db->prepare($sql);
            $parameters = array(
                ":is_album" => $isAlbum,
                ":obj_id" => $objId,
                ":reply_to" => $replyTo
            );
            $query->execute($parameters);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function getCommentPost($isAlbum, $objId)
    {
        $sql = "SELECT comments.*, users.username, users.avatar, users.fullname FROM comments INNER JOIN users ON comments.user_id = users.user_id WHERE comments.is_album = :is_album AND comments.obj_id = :obj_id AND comments.reply_to = :reply_to ORDER BY comments.created_at ASC";
        try{
            $query = $this->db->prepare($sql);
            $parameters = array(
                ":is_album" => $isAlbum,
                ":obj_id" => $objId,
                ":reply_to" => 0
            );
            $query->execute($parameters);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function createAlbum($contentType, $userId)
    {
        $sql = "INSERT INTO albums (content_type, user_id) VALUES (:content_type, :user_id)";
        try {
            $query = $this->db->prepare($sql);
            $parameters = array(
                ":content_type" => $contentType,
                ":user_id" => $userId
            );
            $query->execute($parameters);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function createImage($link, $albumId)
    {
        $sql = "INSERT INTO images (link, album_id) VALUES (:link, :album_id)";
        try {
            $query = $this->db->prepare($sql);
            $parameters = array(
                ":link" => $link,
                ":album_id" => $albumId
            );
            $query->execute($parameters);
            return $image_id =  $this->db->lastInsertId();
            $algolia = new Algolia();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAlbumImage($albumId)
    {
        $sql = "SELECT * FROM images WHERE album_id = :album_id";
        try {
            $query = $this->db->prepare($sql);
            $parameters = array(
                ":album_id" => $albumId
            );
            $query->execute($parameters);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function editAlbum($albumId, $caption)
    {
        $sql = "UPDATE albums SET caption = :caption WHERE album_id = :album_id";
        try {
            $query = $this->db->prepare($sql);
            $parameters = array(
                ":caption" => $caption,
                ":album_id" => $albumId
            );
            return $query->execute($parameters);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function editImage($albumId, $imageId, $caption)
    {
        $sql = "UPDATE images SET caption = :caption WHERE album_id = :album_id AND image_id = :image_id";
        try {
            $query = $this->db->prepare($sql);
            $parameters = array(
                ":caption" => $caption,
                ":album_id" => $albumId,
                ":image_id" => $imageId
            );
            return $query->execute($parameters);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function checkTags($tagNames)
    {
        $sql = "SELECT * FROM tags WHERE tag_name = :tag_name";
        try{
            $query = $this->db->prepare($sql);
            $parameters = array(
                ":tag_name" => $tagNames
            );
            $query->execute($parameters);
            return $query->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function createTag($tagNames)
    {
        $sql = "INSERT INTO tags (tag_name) VALUES (:tag_name)";
        try{
            $query = $this->db->prepare($sql);
            $parameters = array(
                ":tag_name" => $tagNames
            );
            return $query->execute($parameters);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function likeAlbum($isAlbum, $objId, $userId)
    {
        $sql = "INSERT INTO likes (is_album, obj_id, user_id, active) VALUES (:is_album, :obj_id, :user_id, :active)";
        try{
            $query = $this->db->prepare($sql);
            $parameters = array(
                ":is_album" => $isAlbum,
                ":obj_id" => $objId,
                ":user_id" => $userId,
                ":active" => 1
            );
            $query->execute($parameters);
            return $query->rowCount();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function statusLikeAlbum($objId, $userId)
    {
        $sql = "SELECT active FROM likes WHERE obj_id = :obj_id AND user_id = :user_id";
        try{
            $query = $this->db->prepare($sql);
            $parameters = array(
                ":obj_id" => $objId,
                ":user_id" => $userId
            );
            $query->execute($parameters);
            return $query->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function updateLikeAlbum($active, $userId, $objId)
    {
        $sql = "UPDATE likes SET active = :active WHERE user_id = :user_id AND obj_id = :obj_id";
        try{
            $query = $this->db->prepare($sql);
            $parameters = array(
                ":active" => $active,
                ":user_id" => $userId,
                ":obj_id" => $objId
            );
            return $query->execute($parameters);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }


//    public function getCommentsAlbum($objId)
//    {
//        $sql = "SELECT comments.*, users.username, users.avatar FROM comments INNER JOIN users ON comments.user_id = users.user_id WHERE comments.obj_id = :obj_id ORDER BY comments.created_at ASC";
//        try{
//            $query = $this->db->prepare($sql);
//            $parameters = array(
//                ":obj_id" => $objId
//            );
//            $query->execute($parameters);
//            return $query->fetchAll(PDO::FETCH_ASSOC);
//        }catch(PDOException $e){
//            echo $e->getMessage();
//        }
//    }

    public function getCommentsAlbum($objId)
    {
        $sql = "SELECT comments.*, users.username, users.avatar, users.fullname FROM comments INNER JOIN users ON comments.user_id = users.user_id WHERE comments.obj_id = :obj_id AND comments.reply_to = :reply_to ORDER BY comments.created_at ASC";
        try{
            $query = $this->db->prepare($sql);
            $parameters = array(
                ":obj_id" => $objId,
                ":reply_to" => 0
            );
            $query->execute($parameters);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function createCommentPost($replyTo, $comment, $isAlbum, $objId, $userId)
    {
//        die(var_dump($isAlbum));
        $isAlbum = $isAlbum == '1' ? true : false;

        $sql = "INSERT INTO comments (reply_to, comment, is_album, obj_id, user_id) VALUES (:reply_to, :comment, :is_album, :obj_id, :user_id)";
        try{
            $query = $this->db->prepare($sql);
            $parameters = array(
                ":reply_to" => $replyTo,
                ":comment" => $comment,
                ":is_album" => $isAlbum,
                ":obj_id" => $objId,
                ":user_id" => $userId
            );

            $query->execute($parameters);
//            die(json_encode($query));
            return $this->db->lastInsertId();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getCommentById($commentId)
    {
        $sql = "SELECT comments.*, users.avatar, users.username FROM comments INNER JOIN users ON comments.user_id = users.user_id WHERE comments.comment_id = :comment_id";
        try{
            $query = $this->db->prepare($sql);
            $parameters = array(
                ":comment_id" => $commentId
            );
            $query->execute($parameters);
            return $query->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function checkLike ($obj_id, $isAlbum, $userId) {
        $sql = "SELECT likes.active FROM likes WHERE is_album = $isAlbum AND obj_id = $obj_id AND user_id = $userId";
        try {
            $query = $this->db->prepare($sql);
            return $query->execute();

        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }

}