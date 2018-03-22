<?php

namespace models;

require_once 'ModelBase.php';
require_once 'Post.php';
require_once 'PostRepository.php';

use \PDO;

class PostDataBaseRepository extends ModelBase implements PostRepository {
    private $dbh;

    public function __construct() {
        //$this->dbh = $dbh;
        $this->dbh = $this->createDBHandle();
    }

    function findById($id) {
        $stmt = $this->dbh->prepare('SELECT id, title, asset_path, filename, video_type, uploaded_at FROM posts WHERE id = :id');
        $param = array(':id' => $id);
        $stmt->execute($param);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $post = $this->toEntity($result);

        return $post;
    }

    function findAll() {
        $stmt = $this->dbh->prepare('SELECT id, title, asset_path, filename, video_type, uploaded_at FROM posts ORDER BY :order_key');
        $param = array(':order_key' => 'created_at');
        $stmt->execute($param);

        $posts = array();
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post = $this->toEntity($result);
            array_push($posts, $post);
        }

        return $posts;
    }

    private function toEntity($result) {
        return new Post(
            $result['id'],
            $result['title'],
            $result['asset_path'],
            $result['filename'],
            $result['video_type'],
            $result['uploaded_at']);
    } 
}

?>

