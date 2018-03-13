<?php
new PDO();

//print_r($_SERVER);

$method = $_SERVER['REQUEST_METHOD'];
$path   = $_SERVER['PATH_INFO'];

echo "$method  $path  \n";

?>
