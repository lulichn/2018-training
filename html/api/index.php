<?php
require_once './NotFound.php';

$param = ereg_replace('/?$', '', $_SERVER['PATH_INFO']);
$params = array();
if ('' != $param) {
  // パラメーターを / で分割
  $params = explode('/', $param);
}

if (! isset($params[1])) {
  // 404 を返す
  NotFound::display();
}

$className = $params[1];
$method    = $_SERVER['REQUEST_METHOD'];

require_once './controllers/' . $className . '.php';
$instance = new $className();

$instance->$method();

?>

