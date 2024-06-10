<?php
$HOST = "localhost";
$USER = "root";
$PASS = "";
$DB = "grocDB";

$con = mysqli_connect($HOST,$USER,$PASS,$DB);

$id = $_POST['id'];
$pname = $_POST['pname'];
$categ = $_POST['cate'];
$price = $_POST['price'];
$unit = $_POST['unit'];
$minim = $_POST['minim'];
$descp = $_POST['descr'];
if($descp == ''){ $descp = '...'; }
$update = "UPDATE `product` SET p_name = '$pname', price = $price, c_id = $categ, min_req = $minim, `descp` = '$descp', unit_type = '$unit' WHERE id = $id ";
$result = mysqli_query($con,$update);
if($result){
    echo 1;
}else{
    echo 0;
}
?>