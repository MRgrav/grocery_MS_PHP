<?php 
include_once "../../components/connection.php"; 
session_start();
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-bulma/bulma.css">
    <title>CMS | New Products</title>
</head>
<body class="m-0 p-0">
    <div class="row" style="height: 100vh;">
        <div class="col bg-cmn pe-3 h-100 align-items-center pt-5"><center>
            <div class="p-2 pt-5 h-90 w-50 ">
                <div class="border border-dark rounded h-100 p-5 bg-white">
                    <div class="d-flex flex-row">
                        <div class="tile bg-white text-dark shadow-toon w-100">
                            <p class="fs-3 pb-3 border-bottom border-dark"><strong>
                                New Product</strong>
                            </p>
                            <form action="" method="post">
                                <table class="table border border-white">
                                    <tr>
                                        <td scope="col">Product Name</td>
                                        <td scope="col">
                                        <input type="text" class="col p-2 ps-3 rounded border border-dark w-100"
                                            placeholder="product name" name="product" minlength="3" maxlength="50" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col">Categories</td>
                                        <td scope="col">
                                        <select class="col p-2 ps-3 rounded border bg-white border-dark w-100" name="categ" required>
                                            <option selected disabled>--select--</option>
                                        <?php
                                            $query = "SELECT * FROM `categories` ";
                                            $result = mysqli_query($con, $query);
                                            while($data = mysqli_fetch_assoc($result)){
                                                echo "<option value='".$data['id']."'>".$data['c_name']."</option>";
                                            } ?>
                                        </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Minimum Quantity</td>
                                        <td><input class="w-100 border border-dark rounded ps-3 p-2" name="minq" placeholder="minimum quantity to be available"
                                        type="text" onkeypress="return event.charCode>=48 && event,charCode<-57" required></td>
                                    </tr>
                                    <tr>
                                        <td>Unit type</td>
                                        <td><select class="col p-2 ps-3 rounded border bg-white border-dark w-100" name="unitType" required>
                                            <option selected disabled>--select--</option>
                                            <option value="pcs">pcs <small>(pieces)</small></option>
                                            <option value="ltr">ml <small>(ml)</small></option>
                                            <option value="ltr">ltr <small>(litter)</small></option>
                                            <option value="g">g <small>(gram)</small></option>
                                            <option value="kg">kg <small>(killogram)</small></option>
                                        </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td><input class="w-100 border border-dark rounded ps-3 p-2" name="price" type="text" placeholder="price per unit/kg" 
                                        onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode=46" required></td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td><textarea class="rounded border border-dark w-100" name="descr" maxlength="100" cols="30" rows="2"></textarea></td>
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
</html>

<?php 
if(isset($_POST['submit'])){
    $pName = $_POST['product'];
    $cId = $_POST['categ'];
    $price = $_POST['price'];
    //$desc = $_POST['descr'];
    if($_POST['descr']==''){ $desc = NULL; }else{ $desc = $_POST['descr']; }
    $mnm = $_POST['minq']; 
    $utp = $_POST['unitType'];
    
    $id = $_SESSION['id'];
    //echo "  :  ".$_SESSION['id']." : ".session_status();

    $query = "INSERT INTO `product` VALUES(Null,'$pName',$price,'$desc',$cId,0,0,-1,$id,$mnm,'$utp') ";
    //INSERT INTO `product`(`id`, `p_name`, `price`, `description`, `c_id`, `stock_in`, `stock_out`, `available`, `a_id`, `min_req`, `unit_tyoe`) 
    //VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]')
    echo $query;
    $result = mysqli_query($con,$query);
    if($result){
        //success message
        echo "
        <script>
        Swal.fire({
            icon: 'success',
            text: 'Product added successfully!'
        });
        </script>
        ";
    }else{
        //failed message
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            text: 'Something is wrong!'
        });
        </script>
        ";
    }
}
?>