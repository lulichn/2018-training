<?php

// アプリケーションのルートディレクトリパス
define('APP_PATH', realpath(dirname(__FILE__) . '/../../app/src'));

// include_pathに追加
$includes = array(APP_PATH);
$incPath = implode(PATH_SEPARATOR, $includes);
set_include_path(get_include_path() . PATH_SEPARATOR . $incPath);

// 設定ファイルの読み込み
require_once 'Config.php';

// Dispatcher
require_once 'Dispatcher.php';

// リクエスト処理
$dispatcher = new Dispatcher();
$dispatcher->setSystemRoot(APP_PATH);
$dispatcher->dispatch();

?>

