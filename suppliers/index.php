<?php
include_once "../components/header.php"; 
//get page number
if(isset($_GET['pg'])){
    $pg = $_GET['pg'];
}else{
    $pg = 1;
}
$_SESSION['page'] = 'Suppliers'; 
?>
    <title>GMS | Suppliers</title>
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
                        <div class="ps-3 h-100">
                            <a class="h-100 btn btn-success text-nowrap p-2 shadow shadow-sm" href="./add-supplier/">Add Supplier</a>
                        </div>
                    </div>
                    <hr class="border-dark">
                    <div class="d-flex flex-row">
                        <div class="tile bg-white text-dark shadow shadow-sm w-100 overflow-auto pt-0" style="height: 63vh;">
                            <p class="fs-5 border-bottom border-dark pt-3 pb-1 bg-white sticky-top mb-1">
                                Suppliers
                            </p>
                            <table class="table table-striped border border-success rounded">
                                <tr class="bg-success rounded">
                                    <th class="text-white">Sl No.</th>
                                    <th class="text-white">
                                        Name
                                        <a href="./index.php?sort=nasc">
                                            <i class="fi fi-sr-arrow-up text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'nasc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                        <a href="./index.php?sort=ndsc">
                                            <i class="fi fi-sr-arrow-down text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'ndsc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                    </th>
                                    <th class="text-white">Phone No.</th>
                                    <th class="text-white">
                                        Address
                                        <a href="./index.php?sort=aasc">
                                            <i class="fi fi-sr-arrow-up text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'aasc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                        <a href="./index.php?sort=adsc">
                                            <i class="fi fi-sr-arrow-down text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'adsc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                    </th>
                                    <th class="text-white">View</th>
                                </tr>
                                <?php
                                //search base
                                $query = "SELECT * FROM `suppliers` ";
                                if(isset($_GET['search'])){
                                    $srch = $_GET['search'];
                                    $query .= "WHERE s_name LIKE '%".$srch."%' ";
                                }
                                if(isset($_GET['sort'])){
                                    $sortType = $_GET['sort'];
                                    switch ($sortType) {
                                        case 'nasc':
                                            $query .= "ORDER BY s_name ASC ";
                                            break;
                                        case 'ndsc':
                                            $query .= "ORDER BY s_name DESC ";
                                            break;
                                        case 'aasc':
                                            $query .= "ORDER BY address ASC ";
                                            break;
                                        case 'adsc':
                                            $query .= "ORDER BY address DESC ";
                                            break;
                                    }
                                }else{
                                    $query .= "ORDER BY s_name ASC ";
                                }
                                //page counter
                                $numrow = mysqli_num_rows(mysqli_query($con,$query));
                                $numpg = ceil($numrow/10);
                                //serail number
                                $sl = 1 + ($pg * 10) - 10;
                                $query .= "LIMIT ".($sl-1).",10 ";
                                $result = mysqli_query($con, $query);
                                while($data = mysqli_fetch_assoc($result)){
                                    echo "
                                    <tr>
                                        <td>".$sl."</td>
                                        <td>".$data['s_name']."</td>
                                        <td>".$data['phone']."</td>
                                        <td>".$data['address']."</td>
                                        <td><a href='./view.php?supplier=".$data['id']."' class='btn btn-sm btn-success w-auto'><i class='fi fi-sr-pencil pe-2'></i>view</a></td>
                                    </tr>
                                    ";
                                    $sl++;
                                }
                                ?>
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
        //if ( string != '' ) {
            location.href = "./index.php?search=" + string;
        //}
    });

    var currLoc = $(location).attr('href');
});
</script>