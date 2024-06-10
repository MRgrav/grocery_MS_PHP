<?php
date_default_timezone_set("Asia/Aden");

$HOST = "localhost";
$USER = "root";
$PASS = "";
$DB = "grocDB";

$con = mysqli_connect($HOST,$USER,$PASS,$DB);

define ("SECRETKEY", "mysecretkey1234");
?>