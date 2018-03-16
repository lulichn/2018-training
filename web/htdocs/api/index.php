<?php

// アプリケーションのルートディレクトリパス
define('APP_PATH', realpath(dirname(__FILE__) . '/../../app'));

// include_pathに追加
$includes = array(APP_PATH);
$incPath = implode(PATH_SEPARATOR, $includes);
set_include_path(get_include_path() . PATH_SEPARATOR . $incPath);

// 設定ファイルの読み込み
require_once 'Config.php';

// クラスのオートロード設定
function __autoload($className){
    require_once $className . ".php";
}

// $connInfo = array(
//    'host'     => 'localhost',
//    'dbname'   => 'sample',
//    'dbuser'   => 'hoge',
//    'password' => 'xxxxxxxx'
//);
//ModelBase::setConnectionInfo($connInfo);

// リクエスト処理
$dispatcher = new Dispatcher();
$dispatcher->setSystemRoot(APP_PATH);
$dispatcher->dispatch();

?>

