<?php
session_start();
if($_SESSION['lst']!=true){
    header("location:/grocery/index.php");
}
$num = $_POST['num'];
$dtp = $_POST['dType'];

include_once "../../components/connection.php";

if($dtp == "fetch"){
    $result = mysqli_query($con,"SELECT * FROM `customer` WHERE phone = ".$num." ");
    if($data = mysqli_fetch_array($result
    )){
        echo $data['name']."/".$data['address']."/".$data['id'];
    }else{
        echo 0;
    }
    
}elseif ($dtp == "newCust") {
    # code...
    $name = $_POST['name'];
    $addr = $_POST['addr'];
    $query = "INSERT INTO `customer` VALUES(NULL,'$name',$num,'$addr')";
    mysqli_query($con,$query);
    $query = "SELECT id FROM customer ORDER BY id DESC ";
    $data = mysqli_fetch_array(mysqli_query($con,$query));
    echo $data['id'];
}else{
    $query = "SELECT * FROM `customer` WHERE `phone` LIKE '".$num."%' ";
    $result = mysqli_query($con,$query);
    $res = '';
    while($data = mysqli_fetch_assoc($result)){
        $res .= "<option value='".$data['phone']."'>".$data['phone']."</option>";
    }
    echo $res;
}
?>