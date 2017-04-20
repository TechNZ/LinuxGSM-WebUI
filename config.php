<?php
//ini_set('display_errors', 'On');
   define('DB_SERVER', '127.0.0.1:3306');
   define('DB_USERNAME', 'database_user');
   define('DB_PASSWORD', 'database_pass');
   define('DB_DATABASE', 'database');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>