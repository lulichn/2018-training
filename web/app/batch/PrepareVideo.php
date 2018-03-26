<?php

// アプリケーションのルートディレクトリパス
define('APP_PATH', realpath(dirname(__FILE__) . '/../../app'));

// include_pathに追加
$includes = array(APP_PATH);
$incPath = implode(PATH_SEPARATOR, $includes);
set_include_path(get_include_path() . PATH_SEPARATOR . $incPath);


require_once 'Config.php';
require_once 'infrastructure/PostDataBaseRepository.php';
require_once 'infrastructure/UploadJobQueueDataBaseRepository.php';
require_once 'services/PrepareVideoService.php';

echo "===== Prepare video (Start) =====\n";

$jobQueueRepo = new \models\UploadJobQueueDataBaseRepository();
$postRepo     = new \models\PostDataBaseRepository();

$service = new \services\PrepareVideoService($postRepo, $jobQueueRepo);

$service->foo();
echo "===== Prepare video (End) =====\n";

?>

