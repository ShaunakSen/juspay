<?php

//turn on output buffering
ob_start();

session_start();
//session_destroy();


//define database config

defined("DB_HOST") ? null : define("DB_HOST", "mysql.hostinger.in");
defined("DB_USER") ? null : define("DB_USER", "u817747483_root");
defined("DB_PASS") ? null : define("DB_PASS", "littlemini");
defined("DB_NAME") ? null : define("DB_NAME", "u817747483_juspa");


$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
require_once("functions.php");

?>