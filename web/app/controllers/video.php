<?php

require_once 'AbstractControllerBase.php';
require_once 'models/PostDataBaseRepository.php';
require_once 'services/PostService.php';

/**
  * /api/video
  */
class Video extends AbstractControllerBase {
    /**
      * Method: GET
      */
    public function get() {
        $id = $this->get_value($_GET, 'id');
        if (! $id) {
          header("Content-type: application/json; charset=utf-8");
          echo json_encode(array('status' => 'ng', 'message' => 'invalid parameter'));
          exit;
        }

        $repo = new models\PostDataBaseRepository();
        $service = new services\PostService($repo);

        $resp = $service->getPost($id);
        if ($resp === FALSE) {
            header("Content-type: applocation/json; charset=utf-8");
            echo json_encode(array('status' => 'ng', 'message' => 'not found'));
            exit;
        }

        $service->incrementViewCount($id);

        header("Content-type: appication/json; charset=utf-8");
        echo json_encode($resp->toArray());
    }
}

?>
