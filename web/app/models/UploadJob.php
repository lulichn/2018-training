<?php

namespace models;

require_once 'support/Enum.php';

class UploadJob {
    /**
      * @var string
      */
    private $id;

    /**
      * @var string
      */
    private $title;

    /**
      * @var string
      */
    private $filePath;

    /**
      * @var UploadJobStatus
      */
    private $status;

    /**
      * @var string
      */
    private $uploadedAt;

    public function __construct(
        $id,
        $title,
        $filePath,
        $status,
        $uploadedAt)
    {
        $this->id = $id;
        $this->title = $title;
        $this->filePath = $filePath;
        $this->status = $status;
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

    public function getStatus() {
        return $this->status;
    }

    public function getUploadedAt() {
        return $this->uploadedAt;
    }
}

/**
  * Enum
  * UploadJob Status
  */
class UploadJobStatus extends \Enum {
    static $INIT;
    static $PROCESSING;
    static $DONE;

    private $displayName;
    public function __construct($displayName) {
        $this->displayName = $displayName;
    }

    public function init() {
        self::$INIT       = new UploadJobStatus("init");
        self::$PROCESSING = new UploadJobStatus("processing");
        self::$DONE       = new UploadJobStatus("done");
    }
}
// initialize enum UploadJobStatus
UploadJobStatus::init();

?>

