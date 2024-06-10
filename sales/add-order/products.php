<?php
include_once "../../components/connection.php";
session_start();
if($_SESSION['lst']!=true){
    header("location:/grocery/index.php");
}

if(isset($_POST['pName'])){
    $pName = $_POST['pName'];
    $result = mysqli_query($con,"SELECT id, p_name FROM `product` WHERE `p_name` LIKE '%".$pName."%' ");
    //echo mysqli_fetch_array($result)['p_name'];
    $res = '';
    while($data = mysqli_fetch_assoc($result)){
        $res .= "<option value='".$data['p_name']." | ".$data['id']."'>".$data['p_name']." | ".$data['id']."</option>";
    }
    echo $res;
}

if(isset($_POST['pId'])){
    $id = $_POST['pId'];
    $quan = $_POST['quan'];
    $result = mysqli_query($con,"SELECT * FROM product WHERE id = $id ");
    $data = mysqli_fetch_array($result);
    $total = $data['price'] * $quan;
    echo "    
    <tr>
        <td class='border border-dark p-0'>
            <input type='text' class='w-100 p-3 text-start border-0' value='".$data['p_name']."' readonly>
            <input type='hidden' value='".$id."' name='id[]' required>
        </td>
        <td class='border border-dark text-center p-0' style='max-width: 60px;'>
            <input type='text' class='w-100 p-3 text-end border-0' maxlength='2' value='".$quan."' name='quan[]' readonly>
        </td>
        <td class='border border-dark text-end p-0' style='max-width: 60px;'>
            <input type='text' class='w-100 p-3 text-end border-0' value='".$data['price']."' readonly>
        </td>
        <td class='border border-dark text-end p-0' style='max-width: 80px;'>
            <input type='text' class='w-100 p-3 text-end border-0 amn' value='".$total."' id='amn' name='amount[]' readonly>
        </td>
        <td class='border border-dark text-center pt-2'>
            <button class='btn bg-danger text-white btn-sm' id='remv'>remove</button>
        </td>
    </tr>
    ^~^".$total;
}
/*

*/
?>