<?php 
include_once "../components/header.php"; 
$_SESSION['page'] = "Dashboard";
?>
    <title>GMS | Dashboard</title>
</head>
<body class="container-fluid">
    <div class=" row" style="height: 100vh;">
        <?php include_once "../components/nav.php"; ?>
        <div class="col bg-cmn h-100">
            <div class="mb-auto p-2 pt-3 h-90 w-100 ">
                <div class="border border-dark border-2 rounded-top h-100 p-5 pt-4 bg-white">
                    <?php include_once "../components/topbar.php"; 
                    if($_SESSION['message']=='go'){
                        echo "
                        <script>
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'You have been logged in!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        </script>";
                    }
                    $_SESSION['message'] = '';
                    $qur = "SELECT SUM(amount) AS sale FROM invoice WHERE p_date = curdate() ";
                    $sale = mysqli_fetch_array(mysqli_query($con,$qur));
                    $cust = mysqli_query($con,"SELECT COUNT(*) AS total_c FROM `customer` ");
                    $customer = mysqli_fetch_array($cust);
                    $products = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(*) AS total_p FROM product "));
                    //availability
                    $query = "SELECT p_name, available FROM `product` WHERE available>=0 AND available<=min_req ";
                    $res = mysqli_query($con,$query);
                    ?>
                    <div class="row m-0">
                        <div class="col-lg-11 col-md-6 col-sm-12 row m-0">
                            <div class="d-flex flex-row m-0 pb-2">
                                <div class="p-3 col-lg-4 col-md-6 col-sm-12">
                                    <div class="bg-primary text-white p-3 rounded-5 border border-dark shadow w-100 scl-12 border-2">
                                        <div class="row px-2">
                                            <div class="col-5 rounded-circle bg-primary-subtle p-4">
                                                <img src="../media/sales.png" class="w-100" alt="">
                                            </div>
                                            <div class="col-7 pt-3"> 
                                                <p class="w-100 text-end fs-1 m-0"><b>
                                                    <?php if($sale['sale']==null){ echo 0;}else{ echo "₹".$sale['sale']; }?>
                                                </b></p>
                                                <p class="fs-6 text-end">Todays sale</p>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                                <div class="p-3 col-lg-4 col-md-6 col-sm-12">
                                    <div class="bg-danger text-white p-3 rounded-5 border border-dark shadow w-100 scl-12 border-2">
                                        <div class="row px-2">
                                            <div class="col-5 rounded-circle bg-danger-subtle p-4">
                                                <img src="../media/customer.png" class="w-100" alt="">
                                            </div>
                                            <div class="col-7 pt-3"> 
                                                <p class="w-100 text-end fs-1 m-0"><b><?php echo $customer['total_c']; ?></b></p>
                                                <p class="fs-6 text-end">Total customers</p>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                                <div class="p-3 col-lg-4 col-md-6 col-sm-12">
                                    <div class="bg-warning text-white p-3 rounded-5 border border-dark shadow w-100 scl-12 border-2">
                                        <div class="row px-2">
                                            <div class="col-5 rounded-circle bg-warning-subtle p-4">
                                                <img src="../media/box.png" class="w-100" alt="">
                                            </div>
                                            <div class="col-7 pt-3"> 
                                                <p class="w-100 text-end fs-1 m-0"><b><?php echo $products['total_p']; ?></b></p>
                                                <p class="fs-6 text-end">Total items</p>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="tile bg-warning-subtle text-danger-emphasis shadow w-100 p-3 border-2" style="height:100%">
                                <p class="fs-5 border-bottom border-dark bg-danger ps-2 text-white rounded-top">
                                    Stock Warning
                                </p>
                                <table class="table table-striped">
                                    <tr><th scope="col">id</th><th scope="col">Name</th><th scope="col">Available</th></tr>
                                    <?php
                                    $i = 1;
                                    while($data = mysqli_fetch_assoc($res)){
                                        echo "<tr><td>".$i."</td><td>".$data['p_name']."</td><td>".$data['available']."</td></tr>";
                                        $i++;
                                    }
                                    if(mysqli_num_rows($res) == 0){
                                        echo "<tr><td colspan='3'>No data</td></tr>";
                                    }
                                    mysqli_close($con);
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once "../components/footer.php"; ?>
        </div>
    </div>
</body>
</html>