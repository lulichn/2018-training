<?php

namespace models;

require_once 'ModelBase.php';
require_once 'UploadJob.php';
require_once 'UploadJobQueueRepository.php';

use \PDO;

class UploadJobQueueDataBaseRepository extends ModelBase implements UploadJobQueueRepository {
    private $dbh;

    public function __construct() {
        $this->dbh = $this->createDBHandle();
    }

    public function findById($id) {
        $stmt = $this->dbh->prepare('SELECT id, title, filePath, uploaded_at FROM upload_job_queue WHERE id = :id');
        $param = array(':id' => $id);
        $stmt->execute($param);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $job = $this->toEntity($result);

        return $result;
    }

    public function save($item) {
        $stmt = $this->dbh->prepare('INSERT INTO upload_job_queue (id, title, file_path) VALUES (:id, :title, :file_path)');
        $param = array(
            ':id'        => $item->getId(),
            ':title'     => $item->getTitle(),
            ':file_path' => $item->getFilePath());

        $stmt->execute($param);
        echo "aaa";
    }

    private function toEntity($result) {
        return new UploadJob(
            $result['id'],
            $result['title'],
            $result['file_path'],
            $result['uploaded_at']);
    }
}

?>

