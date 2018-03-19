<?php

require_once 'models/Posts.php';

class Upload {
  public function post() {
    $uploaddir = '/tmp/';
    $uploadfile = $uploaddir . basename($_FILES['file']['tmp_name']);
    if (! move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
      header("Content-type: text/html; charset=utf-8");
      echo json_encode(array('status' => 'ng'));
      exit;
    }
    
    $resp = array('status' => 'ok');
    
    header("Content-type: text/html; charset=utf-8");
    echo json_encode($resp);
  }
}

?>
