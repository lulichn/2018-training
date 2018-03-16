<?php

namespace models;

require_once 'models/ModelBase.php';
use \PDO;

class Posts extends ModelBase {
    function findAll() {
        $dbh = $this->createDBHandle();

        $stmt = $dbh->prepare('SELECT id, title, thumbnail, created_at FROM posts');
        $stmt->execute();

        $posts = array();
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post = array(
              'id'         => $result['id'],
              'title'      => $result['title'],
              'thumbnail'  => $result['thumbnail'],
              'created_at' => $result['created_at']
            );

            array_push($posts, $post);
        }

        return $posts;
    }
}

?>

