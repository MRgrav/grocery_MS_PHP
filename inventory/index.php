<?php
include_once "../components/header.php";
//get page number
if(isset($_GET['pg'])){
    $pg = $_GET['pg'];
}else{
    $pg = 1;
}
$_SESSION['page'] = 'Inventory';
?>
    <title>GMS | Inventory</title>
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
                    </div>
                    <hr class="border-dark">
                    <div class="d-flex flex-row">
                        <div class="tile bg-white text-dark shadow shadow-sm w-100 overflow-auto pt-0" style="height: 63vh;">
                            <p class="fs-5 border-bottom border-dark pt-3 pb-1 bg-white sticky-top mb-1">
                                Inventory
                            </p>
                            <table class="table table-striped border border-success rounded m-0">
                                <tr class="bg-success rounded">
                                    <th class="text-white">Sl No</th>
                                    <th class="text-white">Product Name</th>
                                    <th class="text-white">
                                        Add
                                        <a href="./index.php?sort=pasc">
                                            <i class="fi fi-sr-arrow-up text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'pasc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                        <a href="./index.php?sort=pdsc">
                                            <i class="fi fi-sr-arrow-down text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'pdsc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                    </th>
                                    <th class="text-white">
                                        Sold
                                        <a href="./index.php?sort=aasc">
                                            <i class="fi fi-sr-arrow-up text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'aasc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                        <a href="./index.php?sort=adsc">
                                            <i class="fi fi-sr-arrow-down text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'adsc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                    </th>
                                    <th class="text-white">
                                        Available
                                        <a href="./index.php?sort=dasc">
                                            <i class="fi fi-sr-arrow-up text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'dasc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                        <a href="./index.php?sort=ddsc">
                                            <i class="fi fi-sr-arrow-down text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'ddsc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                    </th>
                                    <th class="text-white">
                                        Action
                                    </th>
                                </tr>
                                <!--fetch table-->
                                <?php
                                if($_SESSION['message']!=''){
                                    echo $_SESSION['message'];
                                    $_SESSION['message'] = '';
                                }
                                //search base
                                $query = "SELECT product.id, p_name, stock_in, stock_out, min_req, unit_type, available FROM `product` ";
                                if(isset($_GET['search'])){
                                    $srch = $_GET['search'];
                                    $query .= "WHERE p_name LIKE '%".$srch."%' ";
                                }
                                if(isset($_GET['sort'])){
                                    $sortType = $_GET['sort'];
                                    switch ($sortType) {
                                        case 'aasc':
                                            $query .= "ORDER BY stock_out ASC ";
                                            break;
                                        case 'adsc':
                                            $query .= "ORDER BY stock_out DESC ";
                                            break;
                                        case 'dasc':
                                            $query .= "ORDER BY available ASC ";
                                            break;
                                        case 'ddsc':
                                            $query .= "ORDER BY available DESC ";
                                            break;
                                        case 'pasc':
                                            $query .= "ORDER BY stock_in ASC ";
                                            break;
                                        case 'pdsc':
                                            $query .= "ORDER BY stock_in DESC ";
                                            break;
                                    }
                                }else{
                                    $query .= "ORDER BY p_name ASC ";
                                }
                                //page counter
                                $numrow = mysqli_num_rows(mysqli_query($con,$query));
                                $numpg = ceil($numrow/10);
                                //serail number
                                $sl = 1 + ($pg * 10) - 10;
                                $query .= "LIMIT ".($sl-1).",10 ";
                                $result = mysqli_query($con, $query);
                                //end
                                $result = mysqli_query($con, $query);
                                while($data = mysqli_fetch_assoc($result)){
                                ?>
                                    <tr>
                                        <td><?php echo $sl; ?></td>
                                        <td><?php echo $data['p_name']." (".$data['unit_type'].")"; ?></td>
                                        <td><?php echo $data['stock_in']; ?></td>
                                        <td><?php echo $data['stock_out']; ?></td>
                                            <?php 
                                            if($data['available'] == -1){
                                                echo "<td><span class='p-1 px-3 rounded-3 bg-danger shadow text-white'>new</span></td>";
                                            }else{
                                                
                                                if($data['available']<=$data['min_req']){
                                                    echo "<td class='text-danger fw-bold'>".$data['available']."<i class='fi fi-sr-bullet text-danger fs-5'></i></td>";
                                                }else{
                                                    echo "<td>".$data['available']."</td>";
                                                }
                                                
                                            }
                                            ?>
                                        <td>
                                            <a href="./add-product/index.php?id=<?php echo $data['id']."&name=".$data['p_name'];?>" class="btn btn-success btn-sm w-auto">
                                                Add
                                                
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                $sl++; } ?>
                                </table>
                        </div>
                    </div>
                    <hr class="my-2">
                    <?php
                    //pagination;
                    if($numpg>1){
                        echo "<div class='pagination pagination-sm justify-content-end rounded'>";
                        if($pg>1){
                            //prev
                            echo "<div class='page-item'><a class='page-link' href='./index.php?pg=".($pg-1)."'>Prev</a></div>";
                        }
                        if($pg>3){
                            //..
                            echo "<div class='page-item'>..</div>";
                        }
                        if($pg-2>0){
                            echo "<div class='page-item'><a class='page-link' href='./index.php?pg=".($pg-2)."'>".($pg-2)."</a></div>";
                        }
                        if($pg-1>0){
                            echo "<div class='page-item'><a class='page-link' href='./index.php?pg=".($pg-1)."'>".($pg-1)."</a></div>";
                        }
                        echo "<div class='page-item active'><a class='page-link' href=''>".$pg."</a></div>";
                        if($pg+1<=$numpg){
                            echo "<div class='page-item'><a class='page-link' href='./index.php?pg=".($pg+1)."'>".($pg+1)."</a></div>";
                        }
                        if($pg+2<=$numpg){
                            echo "<div class='page-item'><a class='page-link' href='./index.php?pg=".($pg+2)."'>".($pg+2)."</a></div>";
                        }
                        if($pg < $numpg-2){
                            //..
                            echo "<div class='page-item'>..</div>";
                        }
                        if($pg < $numpg){
                            //next
                            echo "<div class='page-item'><a class='page-link' href='./index.php?pg=".($pg+1)."'>Next</a></div>";
                        }
                        echo "</div>";
                    }
                    
                    ?>
                </div>
            </div>
            <?php include_once "../components/footer.php"; ?>
        </div>
    </div>
</body>
<script>

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