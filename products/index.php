<?php
include_once "../components/header.php"; 
//get page number
if(isset($_GET['pg'])){
    $pg = $_GET['pg'];
}else{
    $pg = 1;
}
$_SESSION['page'] = 'Products';
?>
    <title>GMS | Products</title>
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
                            <input type="text" class="form-control p-2 px-4 border border-2 border-success" id="searchText" 
                            value="<?php if(isset($_GET['search'])){ echo $_GET['search']; }?>" placeholder="search">
                            <button class="btn btn-outline-white border border-2 border-success bg-success-subtle" 
                                type="button" id="searchBtn">
                                <img class="scl-12" src="../media/search.png" alt="" width="30px">
                            </button>
                        </div>
                        <div class="ps-3 h-100">
                            <a class="h-100 btn btn-success text-nowrap p-2 shadow shadow-sm" href="./new-product/">Add Products</a>
                        </div>
                    </div>
                    <hr class="border-dark">
                    <div class="d-flex flex-row">
                        <div class="tile bg-white text-dark shadow shadow-sm w-100 overflow-auto pt-0" style="height: 63vh;">
                            <p class="fs-5 border-bottom border-dark pt-3 pb-1 bg-white sticky-top mb-1">
                                Products
                            </p>
                            <table class="table table-striped border border-success rounded m-0">
                                <tr class="bg-success rounded">
                                    <th class="text-white">Sl No</th>
                                    <th class="text-white">
                                        Product Name
                                        <a href="./index.php?sort=nasc<?php if(isset($_GET['search'])){ echo "&search=".$_GET['search']; }?>">
                                            <i class="fi fi-sr-arrow-up text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'nasc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                        <a href="./index.php?sort=ndsc<?php if(isset($_GET['search'])){ echo "&search=".$_GET['search']; }?>">
                                            <i class="fi fi-sr-arrow-down text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'ndsc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                    </th>
                                    <th class="text-white">
                                        Categories
                                        <a href="./index.php?sort=casc<?php if(isset($_GET['search'])){ echo "&search=".$_GET['search']; }?>">
                                            <i class="fi fi-sr-arrow-up text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'casc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                        <a href="./index.php?sort=cdsc<?php if(isset($_GET['search'])){ echo "&search=".$_GET['search']; }?>">
                                            <i class="fi fi-sr-arrow-down text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'cdsc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                    </th>
                                    <th class="text-white">
                                        Price
                                        <a href="./index.php?sort=pasc<?php if(isset($_GET['search'])){ echo "&search=".$_GET['search']; }?>">
                                            <i class="fi fi-sr-arrow-up text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'pasc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                        <a href="./index.php?sort=pdsc<?php if(isset($_GET['search'])){ echo "&search=".$_GET['search']; }?>">
                                            <i class="fi fi-sr-arrow-down text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'pdsc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                    </th>
                                    <th class="text-white">
                                        Description
                                    </th>
                                    <th class="text-white">Edit</th>
                                </tr>
                                <!--fetch table-->
                                <?php
                                //search base
                                $query = "SELECT product.id, p_name, descp, price, c_name, unit_type  FROM `product` JOIN `categories` ON product.c_id = categories.id ";
                                if(isset($_GET['search'])){
                                    $srch = $_GET['search'];
                                    $query .= "WHERE p_name LIKE '%".$srch."%' ";
                                }
                                if(isset($_GET['sort'])){
                                    $sortType = $_GET['sort'];
                                    switch ($sortType) {
                                        case 'nasc':
                                            $query .= "ORDER BY p_name ASC ";
                                            break;
                                        case 'ndsc':
                                            $query .= "ORDER BY p_name DESC ";
                                            break;
                                        case 'casc':
                                            $query .= "ORDER BY categories.c_name ASC ";
                                            break;
                                        case 'cdsc':
                                            $query .= "ORDER BY categories.c_name DESC ";
                                            break;
                                        case 'pasc':
                                            $query .= "ORDER BY price ASC ";
                                            break;
                                        case 'pdsc':
                                            $query .= "ORDER BY price DESC ";
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
                                //$result = mysqli_query($con, $query);
                                //end
                                $result = mysqli_query($con, $query);
                                while($data = mysqli_fetch_assoc($result)){
                                ?>
                                    <tr>
                                        <td><?php echo $sl; ?></td>
                                        <td><?php echo $data['p_name']; ?></td>
                                        <td><?php echo $data['c_name']; ?></td>
                                        <td><?php echo $data['price']."/".$data['unit_type']; ?></td>
                                        <td><?php echo $data['descp']; ?></td>
                                        <td><a href='./view.php?product=<?php echo $data['id'];?>' class="btn btn-success btn-sm w-auto"><i class="fi fi-sr-pencil pe-2"></i>edit</a></td>
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
</html>
<script>
$(document).ready(function(){
    $("#searchBtn").click(function(){
        console.log("srcc");
        var string = $("#searchText").val();
        if ( string != '' ) {
            location.href = "./index.php?search=" + string;
        }
    });

    var currLoc = $(location).attr('href');
});
</script>