<?php

namespace models;

use \PDO;

abstract class ModelBase {
    function createDBHandle() {
        $dsn = "mysql:dbname=" . DB_NAME . "; host=" . DB_HOST;
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET CHARACTER SET 'utf8mb4'");

	return new PDO($dsn, DB_USER, DB_PASS, $options);
    }
}

?>
