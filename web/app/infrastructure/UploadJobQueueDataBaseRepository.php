<?php

namespace models;

require_once 'ModelBase.php';
require_once 'models/UploadJob.php';
require_once 'models/UploadJobQueueRepository.php';

use \PDO;

class UploadJobQueueDataBaseRepository extends ModelBase implements UploadJobQueueRepository {
    private $dbh;

    public function __construct() {
        $this->dbh = $this->createDBHandle();
    }

    public function findById($id) {
        $stmt = $this->dbh->prepare('SELECT id, title, file_path, status, uploaded_at FROM upload_job_queue WHERE id = :id');
        $param = array(':id' => $id);
        $stmt->execute($param);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $job = $this->toEntity($result);

        return $result;
    }

    public function ensureJobs($limit) {
        $stmtJobs = $this->dbh->prepare('SELECT id, title, file_path, status, uploaded_at FROM upload_job_queue WHERE status = :status LIMIT :limit');
        $stmtJobs->bindValue(':status', UploadJobStatus::$INIT->name(), PDO::PARAM_STR);
        $stmtJobs->bindValue(':limit', (int)$limit, PDO::PARAM_INT);

        $stmtUpdate = $this->dbh->prepare('UPDATE upload_job_queue SET status = \'PROCESSING\' where id in (:ids);');

        // Transaction Begin
        $this->dbh->beginTransaction();

        // Fetch jobs
        $stmtJobs->execute();

        // Jobs
        $jobs = array();
        while($result = $stmtJobs->fetch(PDO::FETCH_ASSOC)) {
            print_r($result);
            $job = $this->toEntity($result);
            array_push($jobs, $job);
        }

        // Job IDs
        $jobIds = array_map(function($e) {
            return $e->getId();
        }, $jobs);
        $ids = implode(',', $jobIds);

        // Update Job status
        $stmtUpdate->bindValue(':ids', $ids, PDO::PARAM_STR);
        $stmtUpdate->execute();

        // Transaction End
        $this->dbh->commit();

        return $jobs;
    }

    public function completeJob($id) {
        $stmt = $this->dbh->prepare('UPDATE upload_job_queue SET status = \'DONE\' where id = :id;');

        $param = array(':id' => $id);
        $stmt->execute($param);
    }

    public function save(UploadJob $item) {
        $stmt = $this->dbh->prepare('INSERT INTO upload_job_queue (id, title, file_path, status) VALUES (:id, :title, :file_path, :status)');
        $param = array(
            ':id'        => $item->getId(),
            ':title'     => $item->getTitle(),
            ':file_path' => $item->getFilePath(),
            ':status'    => $item->getStatus()->name());

        $stmt->execute($param);
    }

    private function toEntity($result) {
        return new UploadJob(
            $result['id'],
            $result['title'],
            $result['file_path'],
            UploadJobStatus::valueOf($result['status']),
            $result['uploaded_at']);
    }
}

?>

