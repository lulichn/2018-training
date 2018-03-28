
use video_library;

CREATE TABLE IF NOT EXISTS `upload_job_queue` (
  `id` varchar(32) COLLATE utf8mb4_bin NOT NULL,
  `title` varchar(256) COLLATE utf8mb4_bin NOT NULL,
  `file_path` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `status` enum('INIT','PROCESSING','DONE') COLLATE utf8mb4_bin NOT NULL,
  `uploaded_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

