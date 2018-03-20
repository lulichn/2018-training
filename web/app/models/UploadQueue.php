<?php

namespace models;

require_once 'models/ModelBase.php';
use \PDO;

class UploadQueue extends ModelBase {
    function findById($id) {
        $dbh = $this->createDBHandle();

        $stmt = $dbh->prepare('SELECT id, title, asset, created_at FROM posts WHERE id = :id');
        $param = array(':id' => $id);
        $stmt->execute($param);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function save($item) {
        $dbh = $this->createDBHandle();

        $stmt = $dbh->prepare('INSERT INTO upload_queue (title, upload_path) VALUES (:title, :upload_path)');
        $param = array(':title' => $item['title'], ':upload_path' => $item['upload_path']);
        $stmt->execute($param);
    }
}

?>

