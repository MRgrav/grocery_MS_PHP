<?php
include_once "../components/connection.php";
//$pwd = password_hash('admin',PASSWORD_DEFAULT);
$pwd = openssl_encrypt('admin', "AES-128-ECB", SECRETKEY);
$query = "INSERT INTO `admin` VALUES (125,'admin','$pwd') ";
echo $query;
mysqli_query($con,$query);
?>