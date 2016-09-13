<?php
define('DB_SERVER', "sql205.byethost33.com");
define('DB_USER', "b33_18805286");
define('DB_PASSWORD', "mv2016mv");
define('DB_DATABASE', "b33_18805286_cakehouse");
define('DB_DRIVER', "mysql");

$db = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

date_default_timezone_set("Asia/Taipei");
// print_r($news);

 ?>
