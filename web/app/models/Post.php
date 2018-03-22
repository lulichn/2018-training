<?php

namespace models;

class Post {
    private $id;
    private $title;
    private $assetPath;
    private $filename;
    private $videoType;
    private $viewCount;
    private $uploadedAt;

    public function __construct(
        $id,
        $title,
        $assetPath,
        $filename,
        $videoType,
        $viewCount,
        $uploadedAt)
    {
        $this->id = $id;
        $this->title = $title;
        $this->assetPath = $assetPath;
        $this->filename = $filename;
        $this->videoType = $videoType;
        $this->viewCount = $viewCount;
        $this->uploadedAt = $uploadedAt;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAssetPath() {
        return $this->assetPath;
    }

    public function getFilename() {
        return $this->filename;
    }

    public function getVideoType() {
        return $this->videoType;
    }

    public function getViewCount() {
        return $this->viewCount;
    }

    public function getUploadedAt() {
        return $this->uploadedAt;
    }

    public function toArray() {
        $array = array(
            'id'          => $this->id,
            'title'       => $this->title,
            'asset_path'  => $this->assetPath,
            'filename'    => $this->filename,
            'video_type'  => $this->videoType,
            'view_count'  => $this->viewCount,
            'uploaded_at' => $this->uploadedAt);

        return $array;
    }
}

?>

