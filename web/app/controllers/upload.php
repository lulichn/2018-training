<?php

require_once 'AbstractControllerBase.php';
require_once 'models/UploadQueue.php';

class Upload extends AbstractControllerBase {
  public function post() {
    $id = md5(uniqid(rand(),1));

    $title = $this->get_value($_POST, 'title');
    if (! $title) {
      header("Content-type: application/json; charset=utf-8");
      echo json_encode(array('status' => 'ng'));
      exit;
    }

    $uploaddir = '/tmp/';
    // $uploadfile = $uploaddir . basename($_FILES['file']['tmp_name']);
    $uploadfile = $uploaddir . $id;

    if (! move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
      header("Content-type: application/json; charset=utf-8");
      echo json_encode(array('status' => 'ng'));
      exit;
    }

    $queueItem = array('title' => $title, 'upload_path' => $uploadfile);
    $uq = new models\UploadQueue();
    $uq->save($queueItem);
    
    header("Content-type: application/json; charset=utf-8");
    $resp = array('status' => 'ok');
    echo json_encode($resp);
  }
}

?>
