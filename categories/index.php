<?php
include_once "../components/header.php";
//get page number
if(isset($_GET['pg'])){
    $pg = $_GET['pg'];
}else{
    $pg = 1;
}
$_SESSION['page'] = 'Categories';
?>
    <title>GMS | Categories</title>
</head>
<body class="container-fluid">
    <div class="row" style="height: 100vh;">
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
                    </div>
                    <hr class="border-dark">
                    <div class="d-flex flex-row">
                        <div class="col tile bg-white text-dark shadow shadow-sm w-25 pt-3">
                            <p class="fs-5 border-bottom border-dark pb-1 bg-white sticky-top mb-1">
                                Add Categories
                            </p>
                            <form action="" class="row" id="form" method="post">
                                <p class="w-100 text-start m-0 pt-4">Categories Name</p>
                                <?php if(isset($_GET['ct'])){ 
                                    $query = "SELECT * FROM `categories` WHERE id=".$_GET['ct']." ";
                                    $cdata = mysqli_fetch_array(mysqli_query($con, $query));
                                ?>
                                <input type="text" value="<?php echo $cdata['id']; ?>" name="id" hidden>
                                <div class='p-2'>
                                    <input type='text' class='p-2 w-100' name='cname' value='<?php echo $cdata['c_name']; ?>' required minlength='2'>
                                </div>
                                <div class='p-2 col-6'>
                                    <a class='btn btn-secondary w-100 shadow' href='index.php?pg=<?php echo $pg; ?>'>Cancel</a>
                                </div>
                                <div class='p-2 col-6'>
                                    <input class='btn btn-primary w-100 shadow' name='update' type='submit' value="Update">
                                </div>
                                <?php }else{ ?>
                                <div class="p-2">
                                    <input type="text" class="p-2 w-100" name="cname2" required minlength="2">
                                </div>
                                <div class="p-2 col-6">
                                    <button class="btn btn-secondary w-100 shadow" type="reset">Reset</button>
                                </div>
                                <div class="p-2 col-6">
                                    <input class="btn btn-primary w-100 shadow" name="add" type="submit" value="Add">
                                </div>
                                <?php } ?>
                            </form>
                        </div>
                        <span class="p-3"></span>
                        <div class="tile bg-white text-dark shadow shadow-sm w-75 overflow-auto pt-0" style="height: 63vh;">
                            <p class="fs-5 border-bottom border-dark pt-3 pb-1 bg-white sticky-top mb-1">
                                Categories
                            </p>
                            <table class="table table-striped border border-success rounded m-0">
                                <tr class="bg-success rounded">
                                    <th class="text-white">Sl No</th>
                                    <th class="text-white">
                                        Category Name
                                        <a href="./index.php?sort=casc<?php if(isset($_GET['search'])){ echo "&search=".$_GET['search']; }?>">
                                            <i class="fi fi-sr-arrow-up text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'casc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                        <a href="./index.php?sort=cdsc<?php if(isset($_GET['search'])){ echo "&search=".$_GET['search']; }?>">
                                            <i class="fi fi-sr-arrow-down text-white<?php if(isset($_GET['sort']) AND $_GET['sort'] != 'cdsc'){ echo "-50"; } ?> cursor-pointer"></i>
                                        </a>
                                    </th>
                                    <th class="text-white">Edit</th>
                                </tr>
                                <!--fetch table-->
                                <?php
                                //search base
                                $query = "SELECT * FROM `categories` ";
                                if(isset($_GET['search'])){
                                    $srch = $_GET['search'];
                                    $query .= "WHERE c_name LIKE '%".$srch."%' ";
                                }
                                if(isset($_GET['sort'])){
                                    $sortType = $_GET['sort'];
                                    switch ($sortType) {
                                        case 'casc':
                                            $query .= "ORDER BY c_name ASC ";
                                            break;
                                        case 'cdsc':
                                            $query .= "ORDER BY c_name DESC ";
                                            break;
                                    }
                                }else{
                                    $query .= "ORDER BY c_name ASC ";
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
                                        <td><?php echo $data['c_name']; ?></td>
                                        <td>
                                            <a href='./index.php?pg=<?php echo $pg."&ct=".$data['id'];?>' class="btn btn-success btn-sm w-auto"><i class="fi fi-sr-pencil pe-2"></i>edit</a>
                                            <a href='./index.php?pg=<?php echo $pg."&cd=".$data['id']."&remove=1";?>' class="ms-1 btn btn-danger btn-sm w-auto"><i class="fi fi-sr-cross pe-2"></i>Remove</a>
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

if(isset($_GET['remove'])){
    $id = $_GET['cd'];
    $result = mysqli_query($con,"DELETE FROM `categories` WHERE id = $id ");
    if ($result) {
        echo "<script>
        Swal.fire({
            icon: 'success',
            text: 'Category Deleted successfully!',
            timer: 1680
        });
        
        //location.reload();
        /* setTimeout(function(){
            
        }, 1500); */
        </script>";
    }else{
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            text: 'Category didn't deleted!',
            timer: 1680
        });
        //location.reload();
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
if(isset($_POST['add'])){
    $cName = $_POST['cname2'];
    //$id = $_POST['id'];
    $aquery = "INSERT INTO  `categories` VALUES (null,'$cName') ";
    $result = mysqli_query($con, $aquery);
    if ($result) {
        header("location:index.php");
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Category Added!',
            showConfirmButton: true
        });
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