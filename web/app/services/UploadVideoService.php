<?php

namespace services;

require_once 'models/UploadJob.php';

class UploadVideoService {
    private $jobQueueRepository;

    public function __construct(
        $jobQueueRepository)
    {
        $this->jobQueueRepository = $jobQueueRepository;
    }

    public function uploadVideo($title, $file) {
        $id = md5(uniqid(rand(),1));


        $uploaddir = '/tmp/';
        $uploadfile = $uploaddir . $id;

        if (! move_uploaded_file($file['file']['tmp_name'], $uploadfile)) {
            // error
        }

        $job = new \models\UploadJob($id, $title, $uploadfile, null);
        $this->jobQueueRepository->save($job);
    }
}

?>
