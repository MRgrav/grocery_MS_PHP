<?php
include_once "../components/connection.php";
$id = $_POST['id'];
$name = $_POST['name'];
$res = mysqli_query($con,"SELECT * FROM `admin` WHERE id = $id AND `name` = '$name' ");
if((mysqli_num_rows($res))>0){
    echo 1;
}else{
    echo 0;
}
//echo $res;
?>