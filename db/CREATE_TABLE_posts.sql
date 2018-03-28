
use video_library;

CREATE TABLE IF NOT EXISTS `posts` (
  `id` varchar(32) COLLATE utf8mb4_bin NOT NULL,
  `title` varchar(256) COLLATE utf8mb4_bin NOT NULL,
  `asset_path` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `filename` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `video_type` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `thumbnail` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT '0',
  `uploaded_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

