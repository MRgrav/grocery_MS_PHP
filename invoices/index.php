<?php
include_once "../components/header.php";
//get page number
if(isset($_GET['pg'])){
    $pg = $_GET['pg'];
}else{
    $pg = 1;
}
$_SESSION['page'] = 'Invoices';
?>
    <title>GMS | Invoices</title>
</head>
<body class="container-fluid">
    <div class=" row" style="height: 100vh;">
        <?php include_once "../components/nav.php"; ?>
        <div class="col bg-cmn h-100">
            <div class="mb-auto p-2 pt-3 h-90 w-100 ">
                <div class="border border-dark rounded-top h-100 p-4 pt-4 bg-white border-2">
                    <?php include_once "../components/topbar.php"?>
                    <div class="d-flex flex-row">
                        <div class="input-group shadow shadow-sm rounded">
                            <input type="text" class="form-control p-2 px-4 border border-2 border-success" id="searchText" placeholder="search">
                            <button class="btn btn-outline-white border border-2 border-success bg-success-subtle" 
                                type="button" id="searchBtn">
                                <img class="scl-12" src="../media/search.png" alt="" width="30px">
                            </button>
                        </div>
                        <div class="px-3 h-100 py-1" hidden>
                            <select class="h-100 fs-6 py-auto p-2 border-dark border-2 rounded-3 bg-light" name="" id="">
                                <option selected disabled class="text-seconadry" value="">sort by</option>
                                <option class="" value="date asc">date new to old</option>
                                <option class="" value="date asc">date old to new</option>
                                <option class="" value="date asc">phone number</option>
                                <option class="" value="date asc">amount</option>
                            </select>
                        </div>
                    </div>
                    <hr class="border-dark">
                    <div class="d-flex flex-row">
                        <div class="tile bg-white text-dark shadow shadow-sm w-100 overflow-auto pt-0" style="height: 63vh;">
                            <p class="fs-5 border-bottom border-dark pt-3 pb-1 bg-white sticky-top mb-1">
                                Invoices
                            </p>
                            <table class="table table-striped border border-success rounded m-0">
                                <tr class="bg-success rounded">
                                    <th class="text-white">Sl. No</th>
                                    <th class="text-white">Invoice Id</th>
                                    <th class="text-white">
                                        Customer's Name
                                        <a href="./index.php?sort=pasc<?php if(isset($_GET['search'])){ echo "&search=".$_GET['search']; }?>">
                                            <i class="fi fi-sr-arrow-up text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'pasc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                        <a href="./index.php?sort=pdsc<?php if(isset($_GET['search'])){ echo "&search=".$_GET['search']; }?>">
                                            <i class="fi fi-sr-arrow-down text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'pdsc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                    </th>
                                    <th class="text-white">
                                        Phone No.
                                    </th>
                                    <th class="text-white text-end">
                                        Amount
                                        <a href="./index.php?sort=aasc<?php if(isset($_GET['search'])){ echo "&search=".$_GET['search']; }?>">
                                            <i class="fi fi-sr-arrow-up text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'aasc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                        <a href="./index.php?sort=adsc<?php if(isset($_GET['search'])){ echo "&search=".$_GET['search']; }?>">
                                            <i class="fi fi-sr-arrow-down text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'adsc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                    </th>
                                    <th class="text-white text-end">
                                        Date
                                        <a href="./index.php?sort=dasc<?php if(isset($_GET['search'])){ echo "&search=".$_GET['search']; }?>">
                                            <i class="fi fi-sr-arrow-up text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'dasc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                        <a href="./index.php?sort=ddsc<?php if(isset($_GET['search'])){ echo "&search=".$_GET['search']; }?>">
                                            <i class="fi fi-sr-arrow-down text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'ddsc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                    </th>
                                    <th class="text-white text-center">
                                        Reciept
                                    </th>
                                </tr>
                                <!--fetch table-->
                                <?php
                                //search base
                                $query = "SELECT invoice.id, invoice.amount, invoice.p_date, customer.phone, customer.name FROM `invoice` JOIN `orders` ON invoice.id = orders.inv_id JOIN `customer` ON orders.c_id = customer.id ";
                                if(isset($_GET['search'])){
                                    $srch = $_GET['search'];
                                    $query .= "WHERE p_name LIKE '%".$srch."%' OR inv_id LIKE '%".$srch."%' ";
                                }
                                if(isset($_GET['sort'])){
                                    $sortType = $_GET['sort'];
                                    switch ($sortType) {
                                        case 'pasc':
                                            $query .= "ORDER BY customer.name ASC ";
                                            break;
                                        case 'pdsc':
                                            $query .= "ORDER BY customer.name DESC ";
                                            break;
                                        case 'dasc':
                                            $query .= "ORDER BY p_date ASC ";
                                            break;
                                        case 'ddsc':
                                            $query .= "ORDER BY p_date DESC ";
                                            break;
                                        case 'aasc':
                                            $query .= "ORDER BY amount ASC ";
                                            break;
                                        case 'adsc':
                                            $query .= "ORDER BY amount DESC ";
                                            break;
                                    }
                                }else{
                                    $query .= "ORDER BY inv_id ASC ";
                                }
                                //page counter
                                $numrow = mysqli_num_rows(mysqli_query($con,$query));
                                $numpg = ceil($numrow/10);
                                //serail number
                                $sl = 1 + ($pg * 10) - 10;
                                $query .= "LIMIT ".($sl-1).",10 ";
                                $result = mysqli_query($con, $query);
                                while($data = mysqli_fetch_assoc($result)){
                                
                                ?>
                                    <tr>
                                        <td><?php echo $sl; ?></td>
                                        <td><?php echo $data['id']; ?></td>
                                        <td><?php echo $data['name']; ?></td>
                                        <td><?php echo $data['phone']; ?></td>
                                        <td class="text-end"><?php echo $data['amount']; ?></td>
                                        <td class="text-end"><?php echo $data['p_date']; ?></td>
                                        <td class="text-center"><a href='./print-invoice/index.php?invoice=<?php echo $data['id']; ?>' class="btn btn-success btn-sm w-auto">print</a></td>
                                    </tr>
                                <?php
                                $sl++; } ?>
                                </table>
                        </div>
                    </div>
                    <hr class="my-2">
                    <?php
                    //pagination;
                    include_once "../components/pagination.php";
                    ?>
                </div>
            </div>
            <?php include_once "../components/footer.php"; ?>
        </div>
    </div>
</body>
<script>
$(document).ready(function(){
    $("#searchBtn").click(function(){
        console.log("srcc");
        var string = $("#searchText").val();
        //if ( string != '' ) {
            location.href = "./index.php?search=" + string;
        //}
    });

    var currLoc = $(location).attr('href');
});
</script>
</html>

<?php

if(isset($_POST['add'])){
    $cName = $_POST['cname'];
    $query = "INSERT INTO `categories` VALUES(NULL,'$cName')";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo "<script>
        Swal.fire(
            'Category added!'
        )
        </script>";
    }else{
        echo "
        <script>
        Swal.fire(
            'Sorry!',
            'error'
        )
        </script>";
    }
}
if(isset($_POST['update'])){
    $cName = $_POST['cname'];
    $id = $_POST['id'];
    $query = "UPDATE `categories` SET c_name = '$cName' WHERE id = $id ";
    $result = mysqli_query($con, $query);
    if ($result) {
        header("location:index.php");
        echo "<script>
        Swal.fire(
            'Category updated!'
        )
        </script>";
    }else{
        echo "
        <script>
        Swal.fire(
            'Sorry!',
            'error'
        )
        </script>";
    }
}
?>