<?php 
include_once "../../components/connection.php"; 
session_start();
if($_SESSION['lst']!=true){
    header("location:/grocery/index.php");
}
$id = $_GET['id'];
$query = "SELECT * FROM `product` WHERE id = $id ";
$result = mysqli_query($con, $query);
$data = mysqli_fetch_array($result);
if($data['available']==-1){
    $avl = 'not available yet';
}else{
    $avl = 'already available '.$data['available'];
}
?>

<!DOCTYPE html>
<html lang="en" style="height: 100vh;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="../../bootstarp/js/bootstrap.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/style.css">
    <script src="/grocery/js/query.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-bulma/bulma.css">
    <title>GMS | Add Products</title>
</head>
<body class="m-0 p-0">
    <div class="row" style="height: 100vh;">
        <div class="col bg-cmn pe-3 h-100 align-items-center pt-5"><center>
            <div class="p-2 pt-5 h-90 w-50 ">
                <div class="border border-dark rounded h-100 p-5 bg-white">
                    <div class="d-flex flex-row">
                        <div class="tile bg-white text-dark shadow-toon w-100">
                            <p class="fs-3 pb-3 border-bottom border-dark"><strong>
                                Add Product</strong>
                            </p>
                            <form action="" method="post">
                                <table class="table border border-white">
                                    <tr>
                                        <td scope="col">Product Name</td>
                                        <td scope="col">
                                        <input type="text" class="col p-2 ps-3 rounded border border-dark w-100" value="<?php echo $data['p_name']; ?>" name="product" minlength="3" maxlength="50" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td><input class="w-100 border border-dark rounded ps-3 p-2" value="<?php echo $data['price']; ?>/-" type="text" name="price" id="price" readonly></td>
                                    </tr>
                                    <tr>
                                        <td scope="col">Quantity</td>
                                        <td scope="col">
                                        <input type="text" class="col p-2 ps-3 rounded border border-dark w-100" id="quan" placeholder="<?php echo $avl; ?>" name="quan"maxlength="2" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Amount</td>
                                        <td><input class="w-100 border border-dark rounded ps-3 p-2" id="amount" placeholder="total amount" type="text" readonly></td>
                                    </tr>
                                    <tr>
                                        <td scope="col">Supplier</td>
                                        <td scope="col">
                                        <select class="col p-2 ps-3 rounded border bg-white border-dark w-100" name="supp" required>
                                            <option selected disabled>--select--</option>
                                        <?php
                                            $query = "SELECT * FROM `suppliers` ";
                                            $result = mysqli_query($con, $query);
                                            while($data = mysqli_fetch_assoc($result)){
                                                echo "<option value='".$data['id']."'>".$data['s_name']."</option>";
                                            } ?>
                                        </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="../" class="btn btn-outline-danger">Back</a></td>
                                        <td><input type="submit" class="btn btn-primary w-100 shadow" name="submit" value="Add"></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div></center>
        </div>
    </div>
</body>
<script>
$(document).ready(function(){
    $('#quan').on("input",function(){
        const price = $('#price').val();
        const quan = $(this).val();
        const amount = parseInt(quan) * parseInt(price);
        $('#amount').attr("value",amount);
    });
});
</script>
</html>

<?php 
if(isset($_POST['submit'])){
    $id = $_GET['id'];
    $quan = $_POST['quan'];
    $price = $_POST['price'];
    $amount = $quan * $price;
    $supp = $_POST['supp'];
    $query = "INSERT INTO `supplied` VALUES (null,$id,$quan,current_timestamp(),$amount,$supp) ";

    //echo "  :  ".$_SESSION['id']." : ".session_status();

    //echo $query;
    
    $result = mysqli_query($con,$query);
    if($result){
        //success message
        //mysqli_query($con,"UPDATE `product` SET available = available WHERE id = $id ");
        $_SESSION['message'] = "
        <script>
        Swal.fire({
            icon: 'success',
            text: 'Product recieved successfully!'
        });
        </script>
        ";
        echo "<script> location.href='../index.php'; </script>";
       // header("location: ../index.php");
    }else{
        //failed message
        $_SESSION['message'] = "
        <script>
        Swal.fire({
            icon: 'error',
            text: 'Something is wrong!'
        });
        </script>
        ";
        echo "<script> location.href='../index.php'; </script>";
    }
}
?>