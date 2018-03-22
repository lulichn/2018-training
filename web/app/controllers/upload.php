<?php

require_once 'AbstractControllerBase.php';
require_once 'models/UploadJobQueueDataBaseRepository.php';
require_once 'services/UploadVideoService.php';

/**
  * /api/upload
  */
class Upload extends AbstractControllerBase {
    /**
      * Method: GET
      */
    public function post() {
        $title = $this->get_value($_POST, 'title');
        if (! $title) {
            header("Content-type: application/json; charset=utf-8");
            echo json_encode(array('status' => 'ng'));
            exit;
        }
  
        $repo = new models\UploadJobQueueDataBaseRepository();
        $service = new services\UploadVideoService($repo);

        $service->uploadVideo($title, $_FILES); 
        
        header("Content-type: application/json; charset=utf-8");
        $resp = array('status' => 'ok');
        echo json_encode($resp);
    }
  }

?>
