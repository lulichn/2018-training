<?php

abstract class AbstractControllerBase {
  function responseError() {
  }

  function get_value($array, $key) {
    if (!isset($array[$key]) || !is_string($array[$key]) || $array[$key] === '') {
      return FALSE;
    }
    return $array[$key];
  }
}

?>
