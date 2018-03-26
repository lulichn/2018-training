<?php

namespace models;

require_once 'ModelBase.php';
require_once 'models/Post.php';
require_once 'models/PostRepository.php';

use \PDO;

class PostDataBaseRepository extends ModelBase implements PostRepository {
    private $dbh;

    public function __construct() {
        //$this->dbh = $dbh;
        $this->dbh = $this->createDBHandle();
    }

    public function findById($id) {
        $stmt = $this->dbh->prepare('SELECT id, title, asset_path, filename, video_type, thumbnail, view_count, uploaded_at FROM posts WHERE id = :id');
        $param = array(':id' => $id);
        $stmt->execute($param);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $post = $this->toEntity($result);

        return $post;
    }

    public function findAll() {
        $stmt = $this->dbh->prepare('SELECT id, title, asset_path, filename, video_type, thumbnail, view_count, uploaded_at FROM posts ORDER BY :order_key');
        $param = array(':order_key' => 'created_at');
        $stmt->execute($param);

        $posts = array();
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post = $this->toEntity($result);
            array_push($posts, $post);
        }

        return $posts;
    }

    public function save(Post $post) {
        $stmt = $this->dbh->prepare('INSERT INTO posts (id, title, asset_path, filename, video_type, thumbnail) VALUES (:id, :title, :asset_path, :filename, :video_type, :thumbnail)');
        $param = array(
            ':id'         => $post->getId(),
            ':title'      => $post->getTitle(),
            ':asset_path' => $post->getAssetPath(),
            ':filename'   => $post->getFilename(),
            ':video_type' => $post->getVideoType(),
            ':thumbnail'  => $post->getThumbnail());

        $stmt->execute($param);
    }

    public function incrementViewCount($id) {
        $stmt = $this->dbh->prepare('UPDATE posts SET view_count = view_count + 1 WHERE id = :id');

        $this->dbh->beginTransaction();

        $param = array(':id' => $id);
        $stmt->execute($param);

        $this->dbh->commit();
    }

    private function toEntity($result) {
        return new Post(
            $result['id'],
            $result['title'],
            $result['asset_path'],
            $result['filename'],
            $result['video_type'],
            $result['thumbnail'],
            $result['view_count'],
            $result['uploaded_at']);
    } 
}

?>

