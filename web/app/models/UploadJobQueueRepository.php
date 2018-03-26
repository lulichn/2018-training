<?php

namespace models;

require_once 'UploadJob.php';

interface UploadJobQueueRepository {
    public function findById($id);
    public function ensureJobs($limit);
    public function completeJob($id);
    public function save(UploadJob $job);
}

?>

