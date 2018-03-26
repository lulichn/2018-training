<?php

namespace services;

require_once 'models/UploadJob.php';
require_once 'models/UploadJobQueueRepository.php';

class UploadVideoService {
    private $jobQueueRepository;

    public function __construct(
        \models\UploadJobQueueRepository $jobQueueRepository)
    {
        $this->jobQueueRepository = $jobQueueRepository;
    }

    public function uploadVideo($title, $file) {
        $id = md5(uniqid(rand(),1));

        $uploadfile = TEMP_PATH . '/' . $id;

        if (! move_uploaded_file($file['file']['tmp_name'], $uploadfile)) {
            // error
        }

        $job = new \models\UploadJob($id, $title, $uploadfile, \models\UploadJobStatus::$INIT, null);
        $this->jobQueueRepository->save($job);
    }
}

?>

