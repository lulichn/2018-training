<?php

class Dispatcher {
    private $sysRoot;

    public function setSystemRoot($path) {
        $this->sysRoot = rtrim($path, '/');
    }

    public function dispatch() {
        $param = ereg_replace('/?$', '', $_SERVER['PATH_INFO']);
        $params = array();
        if ('' != $param) {
            // パラメーターを / で分割
            $params = explode('/', $param);
        }

        if (! isset($params[1])) {
            // 404 を返す
            NotFound::display();
            exit;
        }

        $className = $params[1];
        $method    = $_SERVER['REQUEST_METHOD'];

        require_once $this->sysRoot . '/controllers/' . $className . '.php';
        $instance = new $className();

        $instance->$method();
    }
}

?>

