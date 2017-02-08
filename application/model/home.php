<?php

namespace App\Model;

use App\Core\Controller;
use PDO;
class Home extends Controller
{
    public function getIdAlbum ($stt){
        $sql = "SELECT album_id, user_id FROM albums ORDER BY created_at DESC LIMIT $stt,4";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function checkAbum ($album_id) {
        $sql = "SELECT content_type FROM albums WHERE album_id = $album_id";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getPostId ($album_id) {
        $sql = "SELECT albums.*, images.* FROM albums INNER JOIN images ON albums.album_id = images.album_id  WHERE albums.album_id = $album_id ";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPostId_single ($album_id) {
        $sql = "SELECT albums.*, images.* FROM albums INNER JOIN images ON albums.album_id = images.album_id WHERE albums.album_id = $album_id ";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getProfileUsre ($album_id) {
        $sql = "SELECT albums.*, users.* FROM albums INNER JOIN users ON albums.user_id = users.user_id WHERE album_id = $album_id";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getTagAlbum ($album_id) {
        $sql = "SELECT tags.tag_name FROM  tags INNER JOIN  albums_tags ON tags.tag_id = albums_tags.tag_id WHERE albums_tags.album_id = $album_id";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAvatar ($user_id) {
        $sql = "SELECT users.* FROM users WHERE users.user_id = $user_id";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getImageAvatar ($user_id) {
        $sql = "SELECT  images.* FROM images INNER JOIN albums ON images.album_id = albums.album_id INNER JOIN users ON users.user_id = albums.user_id WHERE users.user_id = $user_id ORDER BY images.created_at  DESC LIMIT 3 ";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCaption ($adbum_id) {
        $sql = "SELECT albums.caption, albums.content, albums.created_at FROM albums WHERE albums.album_id = $adbum_id";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getIdAlbumUser ($user_id) {
        $sql = "SELECT albums.id user_id FROM albums WHERE album_id = $user_id ORDER BY created_at DESC LIMIT 0,3 ";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getPhotoAlbumUser ($album_id) {
        $sql = "SELECT albums.*, images.* FROM albums INNER JOIN images ON albums.album_id = images.album_id  WHERE albums.album_id = $album_id ";
    }

    public function getLikeByUserId($userId, $objId)
    {
        $sql = "SELECT likes.* FROM likes INNER JOIN users ON likes.user_id = users.user_id WHERE likes.user_id = :user_id AND likes.obj_id = :obj_id";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ":user_id" => $userId,
            ":obj_id" => $objId
        );
        $query->execute($parameters);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllIdUser ($id) {
        $sql = "SELECT album_id FROM albums WHERE albums.user_id = $id";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllId () {
        $sql = "SELECT album_id FROM albums";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getImage ($image_id) {
        $sql = "SELECT images.*, users.* FROM images INNER JOIN  albums ON images.album_id = albums.album_id INNER JOIN users ON albums.user_id = users.user_id WHERE image_id = $image_id";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getImages ($album_id) {
        $sql = "SELECT images.* FROM images WHERE images.album_id = $album_id";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getNextImage ($album_id, $image_id) {
        $sql = "(SELECT image_id FROM images WHERE images.image_id > $image_id AND images.album_id = $album_id ORDER BY image_id ASC LIMIT 1)";
        $sql .="UNION (SELECT image_id FROM images WHERE image_id < $image_id  AND album_id = $album_id ORDER BY image_id ASC LIMIT 1) ";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getBackImage ($album_id, $image_id) {
        $sql = "(SELECT image_id FROM images WHERE images.image_id < $image_id AND images.album_id = $album_id ORDER BY image_id DESC LIMIT 1)";
        $sql .="UNION (SELECT image_id FROM images WHERE image_id > $image_id  AND album_id = $album_id ORDER BY image_id DESC LIMIT 1) ";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    // load home_user
    public function loadUser ($id, $stt) {
        $sql = "SELECT albums.album_id FROM albums WHERE user_id = $id ORDER BY created_at DESC LIMIT $stt,3";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function loadImageUser ($album_id) {
        $sql = "SELECT albums.*, images.* FROM albums INNER JOIN images ON albums.album_id = images.album_id  WHERE albums.album_id = $album_id";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    // load user co anh nhieu luot xem nhat
    public function getUserHot ()
    {
        $sql = "SELECT DISTINCT users.*, albums.album_id  FROM users INNER JOIN albums ON users.user_id =albums.user_id INNER JOIN images ON albums.album_id = images.album_id ORDER BY  images.view DESC LIMIT 4";
        try {
            $query = $this->db->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            $e->getMessage();
        }
    }
    // lấy thằng Image nhiều view nhất
    public function getImageOne ()
    {
        $sql = "SELECT users.*, images.*   FROM users INNER JOIN albums ON users.user_id =albums.user_id INNER JOIN images ON albums.album_id = images.album_id ORDER BY  images.view DESC LIMIT 1";
        try
        {
            $query = $this->db->prepare($sql);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        catch (\PDOException $e)
        {
            $e->getMessage();
        }
    }

    // hàm này để update view của ảnh
    public function updateView ($view, $image_id)
    {
        $sql = "UPDATE images SET view = $view WHERE image_id = $image_id";
        $query = $this->db->prepare($sql);
        return $query->execute();
    }
    // lấy like của ảnh theo user_id
    public function getLikeImageByUserId($userId, $objId)
    {
        $sql = "SELECT likes.* FROM likes INNER JOIN users ON likes.user_id = users.user_id WHERE likes.user_id = :user_id AND likes.obj_id = :obj_id AND is_album = 0";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ":user_id" => $userId,
            ":obj_id" => $objId
        );
        $query->execute($parameters);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getUser ($user_id)
    {
        $sql = "SELECT users.* FROM users WHERE  user_id = $user_id";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}