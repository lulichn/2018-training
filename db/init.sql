CREATE DATABASE IF NOT EXISTS video_library DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;

CREATE USER IF NOT EXISTS api@localhost identified by 'password';
GRANT ALL ON video_library.* to api@localhost identified by 'password';
GRANT ALL PRIVILEGES ON video_library.* to api@"%" identified by 'password' WITH GRANT OPTION;
