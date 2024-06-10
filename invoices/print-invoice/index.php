<?php 
include_once "../../components/connection.php"; 
session_start();
if($_SESSION['lst']!=true){
    header("location:/grocery/index.php");
}
$inv = $_GET['invoice'];

$query = "SELECT * FROM `invoice` WHERE id = '$inv' ";
$dataInv = mysqli_fetch_array(mysqli_query($con,$query));    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="../../bootstarp/js/bootstrap.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/style.css">
    <script src="/grocery/js/query.min.js"></script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <title>Invoice_<?php echo $inv; ?></title>
</head>
<script>
$(document).ready(function(){
    function printme(){
        console.log('loaded');
        $('#back').hide();
        $('#printable').show();
        //var body=$('body').html();
        window.print();		
		//window.location.reload(true);
        setTimeout(function(){
			$('#back').show();
            $('#printable').hide();
		}, 10);
    }
    printme();
    $('#printAgain').on("click",function(){
        console.log('a');
        printme();
    });
});
</script>
<body class="container px-2 py-4 h-100">
    <div class="my-auto h-100" id="back">
        <center>
            <a href="../" class="btn btn-secondary shadow px-4 w-auto my-3">back</a>
            <button type="button" class="mx-3 btn btn-info shadow px-4" id="printAgain">Print</button>
        </center>
    </div>
    <div class="m-2 my-0 mt-0 rounded h-90 bg-white" id="printable" style="max-width: 700px; height: auto;">
        <!--top-->
        
        <div class="row py-2 border-bottom border-1 border-dark">
            <div class="col">
                <div class="p-2 border border-dark rounded rounded-4 border-2 shadow shadow-sm" style="width: fit-content;">
                    <a class="navbar-brand fs-6" href="./">
                        <img class="scl-12" src="../../media/shopping-bag.png" alt="" width="24px">
                        <b class="ps-1 pt-2">Grocery MS</b>
                    </a>
                </div>
            </div>
            <div class="col row p-1">
                <strong class="fs-3 text-end text-danger">INVOICE</strong>
            </div>
        </div>
        <!--sub top-->
        <div class="pt-2 row">
            <div class="col">
                <p class="fs-6 fw-"><small>
                    Grocery Store,<br>
                    Jorhat-07,Assam<br>
                    +91 98765 43210
                </small></p>
            </div>
            <div class="col row justify-content-end">
                <table style="width: fit-content; height: fit-content;">
                    <tr>
                        <td class="fw-semibold">Invoice No.</td>
                        <td class="px-2">:</td>
                        <td class="text-end"><?php echo $dataInv['id']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Date</strong></td>
                        <td class="px-2">:</td>
                        <td class="text-end"><?php echo $dataInv['p_date']; ?></td>
                    </tr>
                </table>
            </div>
        </div>        
        <!--main-->
        <div class="row">
            <table class="table border border-1 border-dark bg-waring bg-opacity-10 shadow shadow-sm">
                <tr class="bg-success bg-opacity-25 text-dark">
                    <th class="no-wrap">Sl.No</th>
                    <th>Product Name</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th class="text-end">Total</th>
                </tr>
                <!--data-->
                <?php
                //max 10 row in one page
                $query = "SELECT * FROM `orders` JOIN `product` ON product.id=orders.p_id WHERE inv_id = '$inv' ";
                $i = 1;
                $result = mysqli_query($con,$query);
                while($data = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td class="border border-1 border-dark"><?php echo $i; ?></td>
                    <td class="border border-1 border-dark"><?php echo $data['p_name']; ?></td>
                    <td class="border border-1 border-dark"><?php echo $data['quantity']; ?></td>
                    <td class="border border-1 border-dark text-center"><?php echo $data['price']; ?></td>
                    <td class="border border-1 border-dark text-end"><?php echo $data['amount']; ?></td>
                </tr>
                <?php $i++; } ?>  
            </table>
        
            <div class="pb-3">
                <div class="row pt-2">
                    <div class="offset-7 col-3 text-end">
                        Sub Total : 
                    </div>
                    <div class=" col-2 text-end">
                        <?php echo $dataInv['amount']; ?>
                    </div>
                </div>
                <div class="row py-1">
                    <div class="offset-8 col-2 text-end">
                        Tax : 
                    </div>
                    <div class=" col-2 text-end">
                        NA
                    </div>
                </div>
                <div class="border-top border-dark row py-2">
                    <div class="offset-8 col-2 text-end">
                        Total : 
                    </div>
                    <div class=" col-2 text-end">
                    <?php echo $dataInv['amount']; ?>
                    </div>
                </div>
            </div>
        </div>
        <!--bill to and payment-->
        <?php 
        $query = "SELECT c_id FROM `orders` WHERE inv_id = '$inv' ";
        $getCid = mysqli_fetch_array(mysqli_query($con,$query));
        $cid = $getCid['c_id'];
        $query = "SELECT * FROM `customer` WHERE id = $cid ";
        $dataCust = mysqli_fetch_array(mysqli_query($con,$query));
        ?>
        <div class="row pt-3">
            <div class="col p-2 bg-info-subtle fw-bold rounded-start">Bill To,</div>
            <div class="col p-2 bg-info-subtle fw-bold rounded-end text-end">Payment,</div>
        </div>
        <div class="row pb-3">
            <div class=" col p-2">
                <p><small>
                    <?php echo $dataCust['name'].",<br>+91 ".$dataCust['phone']."<br>".$dataCust['address']; ?>
                </small></p>
            </div>
            <div class="col row justify-content-end">
                <table style="width: fit-content; height: fit-content;">
                    <tr>
                        <td class="p-1"><small>Payment method</small></td>
                        <td class="px-3">:</td>
                        <td class="text-end"><small><?php echo $dataInv['p_method']; ?></small></td>
                    </tr>
                    <tr>
                        <td class="p-1"><small>Status</small></td>
                        <td class="px-3">:</td>
                        <td class="text-end"><small>Paid</small></td>
                    </tr>
                </table>
            </div>
        </div>
        <!--greeting-->
        <div class="p-2 pt-4">
            <p class="fs-6 fw-bold text-center">Thank You For Your Business</p>
        </div>
        <div class="p-1">
            <center><small>copyright &copy; GMS 2023</small></center>
        </div>
    </div>
</body>
</html>