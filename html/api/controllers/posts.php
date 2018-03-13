<?php

class Posts {
  public function get() {
    $resp = array('abc', 'def');

    header("Content-type: text/html; charset=utf-8");
    echo json_encode($resp);
  }
}

?>
