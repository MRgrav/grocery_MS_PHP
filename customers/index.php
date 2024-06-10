<?php 
include_once "../components/header.php"; 
//get page number
if(isset($_GET['pg'])){
    $pg = $_GET['pg'];
}else{
    $pg = 1;
}
$_SESSION['page'] = 'Customers';
?>
    <title>GMS | Customers</title>
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
                        <div hidden class="ps-3 h-100">
                            <a class="h-100 btn btn-success text-nowrap p-2 shadow shadow-sm" href="./add-customer/">Add Customer</a>
                        </div>
                    </div>
                    <hr class="border-dark">
                    <div class="d-flex flex-row">
                        <div class="tile bg-white text-dark shadow shadow-sm w-100 overflow-auto pt-0" style="height: 63vh;">
                            <p class="fs-5 border-bottom border-dark pt-3 pb-1 bg-white sticky-top mb-1">
                                Customers
                            </p>
                            <table class="table table-striped border border-success rounded">
                                <tr class="bg-success rounded">
                                    <th class="text-white">Sl No.</th>
                                    <th class="text-white">
                                        Name
                                        <a href="./index.php?sort=nasc<?php if(isset($_GET['search'])){ echo "&search=".$_GET['search']; }?>">
                                            <i class="fi fi-sr-arrow-up text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'nasc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                        <a href="./index.php?sort=ndsc<?php if(isset($_GET['search'])){ echo "&search=".$_GET['search']; }?>">
                                            <i class="fi fi-sr-arrow-down text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'ndsc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                    </th>
                                    <th class="text-white">Phone No.</th>
                                    <th class="text-white">Address</th>
                                    <th class="text-white">View</th>
                                </tr>
                                <!--fetch table-->
                                <?php
                                //search base
                                $query = "SELECT * FROM `customer` ";
                                if(isset($_GET['search'])){
                                    $srch = $_GET['search'];
                                    $query .= "WHERE `name` LIKE '%".$srch."%' OR `phone` LIKE '%".$srch."%' ";
                                }
                                if(isset($_GET['sort'])){
                                    $sortType = $_GET['sort'];
                                    switch ($sortType) {
                                        case 'nasc':
                                            $query .= "ORDER BY `name` ASC ";
                                            break;
                                        case 'ndsc':
                                            $query .= "ORDER BY `name` DESC ";
                                            break;
                                    }
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
                                        <td><?php echo $data['name']; ?></td>
                                        <td><?php echo $data['phone']; ?></td>
                                        <td><?php echo $data['address']; ?></td>
                                        <td><a href="./view-customer.php?customer=<?php echo $data['id']; ?>" class="btn btn-sm btn-success w-auto">view</a></td>
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
                            echo "<div class='page-item'>
                            <a class='page-link' href='./index.php?pg=".($pg-1); 
                            if(isset($_GET['sort'])){ echo "&sort=".$_GET['sort']; }
                            if(isset($_GET['search'])){ echo "&search=".$_GET['search']; } echo "'>Prev</a></div>";
                        }
                        if($pg>3){
                            //..
                            echo "<div class='page-item'>..</div>";
                        }
                        if($pg-2>0){
                            echo "<div class='page-item'>
                            <a class='page-link' href='./index.php?pg=".($pg-2); 
                            if(isset($_GET['sort'])){ echo "&sort=".$_GET['sort']; }
                            if(isset($_GET['search'])){ echo "&search=".$_GET['search']; } echo "'>".($pg-2)."</a></div>";
                        }
                        if($pg-1>0){
                            echo "<div class='page-item'>
                            <a class='page-link' href='./index.php?pg=".($pg-1); 
                            if(isset($_GET['sort'])){ echo "&sort=".$_GET['sort']; }
                            if(isset($_GET['search'])){ echo "&search=".$_GET['search']; } echo "'>".($pg-1)."</a></div>";
                        }
                        echo "<div class='page-item active'>
                        <a class='page-link' href=''>".$pg."</a></div>";
                        if($pg+1<=$numpg){
                            echo "<div class='page-item'>
                            <a class='page-link' href='./index.php?pg=".($pg+1); 
                            if(isset($_GET['sort'])){ echo "&sort=".$_GET['sort']; }
                            if(isset($_GET['search'])){ echo "&search=".$_GET['search']; } echo "'>".($pg+1)."</a></div>";
                        }
                        if($pg+2<=$numpg){
                            echo "<div class='page-item'>
                            <a class='page-link' href='./index.php?pg=".($pg+2); 
                            if(isset($_GET['sort'])){ echo "&sort=".$_GET['sort']; }
                            if(isset($_GET['search'])){ echo "&search=".$_GET['search']; } echo "'>".($pg+2)."</a></div>";
                        }
                        if($pg < $numpg-2){
                            //..
                            echo "<div class='page-item'>..</div>";
                        }
                        if($pg < $numpg){
                            //next
                            echo "<div class='page-item'>
                            <a class='page-link' href='./index.php?pg=".($pg+1);
                            if(isset($_GET['sort'])){ echo "&sort=".$_GET['sort']; } 
                            if(isset($_GET['search'])){ echo "&search=".$_GET['search']; } echo "'>Next</a></div>";
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