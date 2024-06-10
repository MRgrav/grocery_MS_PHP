<?php
include_once "../../components/connection.php";
session_start();
if($_SESSION['lst']!=true){
    header("location:/grocery/index.php");
}

//first
if(isset($_POST['finSub'])){
    $pid = $_POST['id'];
    //echo $pid;
    $quan = $_POST['quan'];
    $amount = $_POST['amount'];
    $method = $_POST['pmeth'];
    //echo $_POST['pmeth'];
    $c_id = $_POST['cid'];
    //total count
    $total = 0;
    foreach ($amount as $key => $value) {
        $total += $value;
    }
    
    //entry invoice
    $genInv = generateInvoiceId();
    $invoice = "INSERT INTO `invoice` VALUES('$genInv','$method',$total,current_timestamp()) ";
    //echo $invoice;
    $result1 = mysqli_query($con,$invoice);

    
    //order entry
    foreach ($pid as $key => $value) {
        # code...`orders`(`id`, `p_id`, `quantity`, `amount`, `c_id`, `inv_id`)
        $addOrder = "INSERT INTO `orders` VALUES(null,$value,$quan[$key],$amount[$key],$c_id,'$genInv') ";
        //echo $addOrder;     
        $result = mysqli_query($con,$addOrder);
    }

    //alert popup
    if($result1){
        $_SESSION['message'] = "
        <script>
        Swal.fire({
            icon: 'succes',
            title: 'Payment Done!'
        });
        </script>
        ";
        header("location:/grocery/invoices/print-invoice/index.php?invoice=".$genInv."");
    }else{
        $_SESSION['message'] = "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Something is wrong!'
        });
        </scritp>
        ";
        header("location:./index.php");
    }
    
    
} 
function generateInvoiceId(){
    $resInv = "GMS/".date("md")."/".date("hi");
    return $resInv;
}
?>
