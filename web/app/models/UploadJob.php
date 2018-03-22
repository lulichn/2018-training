<?php

namespace models;

class UploadJob {
    private $id;
    private $title;
    private $filePath;
    private $uploadedAt;

    public function __construct(
        $id,
        $title,
        $filePath,
        $uploadedAt)
    {
        $this->id = $id;
        $this->title = $title;
        $this->filePath = $filePath;
        $this->uploadedAt = $uploadedAt;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getFilePath() {
        return $this->filePath;
    }

    public function getUploadedAt() {
        return $this->uploadedAt;
    }
}

?>

