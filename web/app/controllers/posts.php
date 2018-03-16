<?php

require_once 'models/Posts.php';

class Posts {
  public function get() {

    $posts = new models\Posts();
    $resp = $posts->findAll();
    
    header("Content-type: text/html; charset=utf-8");
    echo json_encode($resp);
  }
}

?>
