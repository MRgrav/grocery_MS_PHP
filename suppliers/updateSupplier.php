<?php
include_once "../components/connection.php";
session_start();
if($_SESSION['lst']!=true){
    header("location:/grocery/index.php");
}

if($_POST['action'] == 'update'){
    $id = $_POST['id'];
    $supp = $_POST['supp'];
    $phone = $_POST['phone'];
    $addr = $_POST['addr'];
    $update = "UPDATE `suppliers` SET s_name = '$supp', phone = $phone, address = '$addr' WHERE id = $id ";
    $result = mysqli_query($con,$update);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
}
if($_POST['action'] == 'remove'){
    $id = $_POST['id'];
    $update = "DELETE FROM `suppliers` WHERE id = $id ";
    $result = mysqli_query($con,$update);
    if($result){
        echo '1';
    }else{
        echo '0';
    }
}

?>