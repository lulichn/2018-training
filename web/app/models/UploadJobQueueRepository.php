<?php

namespace models;

interface UploadJobQueueRepository {
    public function findById($id);
    public function save($job);
}

?>

