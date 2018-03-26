<?php

namespace services;

require_once 'models/Post.php';
require_once 'models/PostRepository.php';
require_once 'models/UploadJob.php';
require_once 'models/UploadJobQueueRepository.php';

class PrepareVideoService {
    const SIZE = 10;
    const PERMISSION = 0777;

    const VIDEO_FILENAME = 'video';
    const THUMB_FILENAME = 'thumbnail.jpg';

    private $postRepository;
    private $jobQueueRepository;

    public function __construct(
        \models\PostRepository $postRepository,
        \models\UploadJobQueueRepository $jobQueueRepository)
    {
        $this->postRepository     = $postRepository;
        $this->jobQueueRepository = $jobQueueRepository;
    }

    public function foo() {
        $jobs = $this->ensureJobs();

        foreach($jobs as $job) {
            print_r($job);

            $assetDir = $this->makeAssetDirectory($job);
            $this->makeThumbnail($job->getFilePath(), $assetDir[0] . '/' . self::THUMB_FILENAME);

            $videoFileType = 'video/mp4';

            rename($job->getFilePath(), $assetDir[0] . '/' . self::VIDEO_FILENAME);

            $this->createPost($job->getId(), $job->getTitle(), $assetDir[1], self::VIDEO_FILENAME, $videoFileType, self::THUMB_FILENAME);
            $this->completeJob($job);
        }
    }

    public function ensureJobs() {
        return $this->jobQueueRepository->ensureJobs(self::SIZE);
    }

    public function completeJob($job) {
        return $this->jobQueueRepository->completeJob($job->getId());
    }

    /**
      * @return array
      */
    public function makeAssetDirectory($job) {
        $directory = '/' . $job->getId();
        $fullPath  = ASSET_PATH . $directory;

        mkdir($fullPath, self::PERMISSION);

        return array($fullPath, $directory);
    }

    public function makeThumbnail($in, $to) {
        $cmd = "ffmpeg -i {$in} -vf thumbnail -frames:v 1 {$to}";

        shell_exec($cmd);
    }

    public function createPost($id, $title, $assetDir, $videoFileName, $videoType, $thumbnailFileName) {
        $post = new \models\Post(
            $id,
            $title,
            $assetDir,
            $videoFileName,
            $videoType,
            $thumbnailFileName,
            0,
            null);

        $this->postRepository->save($post);
    }
}

?>

