<?php

require_once 'AbstractControllerBase.php';
require_once 'models/Posts.php';

class Video extends AbstractControllerBase {
  public function get() {
    $id = $this->get_value($_GET, 'id');
    if (! $id) {
      header("Content-type: application/json; charset=utf-8");
      echo json_encode(array('status' => 'ng', 'message' => 'invalid parameter'));
      exit;
    }

    $posts = new models\Posts();
    $resp = $posts->findById($id);
    if ($resp === FALSE) {
      header("Content-type: applocation/json; charset=utf-8");
      echo json_encode(array('status' => 'ng', 'message' => 'not found'));
      exit;
    }

    header("Content-type: appication/json; charset=utf-8");
    echo json_encode($resp);
  }
}

?>
