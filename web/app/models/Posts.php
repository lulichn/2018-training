<?php

namespace models;

require_once 'models/ModelBase.php';
use \PDO;

class Posts extends ModelBase {
    function findById($id) {
        $dbh = $this->createDBHandle();

        $stmt = $dbh->prepare('SELECT id, title, asset, filename, type, created_at FROM posts WHERE id = :id');
        $param = array(':id' => $id);
        $stmt->execute($param);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function findAll() {
        $dbh = $this->createDBHandle();

        $stmt = $dbh->prepare('SELECT id, title, asset, created_at FROM posts ORDER BY :order_key');
        $param = array(':order_key' => 'created_at');
        $stmt->execute($param);

        $posts = array();
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post = array(
              'id'         => $result['id'],
              'title'      => $result['title'],
              'asset'      => $result['asset'],
              'created_at' => $result['created_at']
            );

            array_push($posts, $post);
        }

        return $posts;
    }
}

?>

