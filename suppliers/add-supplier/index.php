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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="../../media/shopping-bag.png">
    <title>GMS | Add Suppliers</title>
</head>
<body class="m-0 p-0">
    <div class="row" style="height: 100vh;">
        <div class="col bg-cmn pe-3 h-100 align-items-center pt-5"><center>
            <div class="p-2 pt-5 h-90 w-50 ">
                <div class="border border-dark rounded h-100 p-5 bg-white">
                    <div class="d-flex flex-row">
                        <div class="tile bg-white text-dark shadow-toon w-100 rounded-3">
                            <p class="fs-3 pb-3 border-bottom border-dark"><strong>
                                New Supplier</strong>
                            </p>
                            <form action="" method="post" id="form">
                                <table class="table border border-white">
                                    <tr>
                                        <td scope="col">Supplier Name</td>
                                        <td scope="col">
                                        <input type="text" name="supp"
                                            class="col p-2 ps-3 rounded border border-dark w-100"
                                            required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col">Phone no.</td>
                                        <td scope="col">
                                            <input class="col p-2 ps-3 rounded border bg-white border-dark w-100" name="phone" 
                                            onkeypress="return event.charCode>=48 && event.charCode<=57" minlength="10" maxlength="12" required>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Address</td>
                                        <td><textarea class="rounded border border-dark w-100" name="addr" cols="30" rows="2" required></textarea></td>
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

include_once "../../components/connection.php";
session_start();
if($_SESSION['lst']!=true){
    header("location:/grocery/index.php");
}

if(isset($_POST['submit'])){
    $suppName = $_POST['supp'];
    $phone = $_POST['phone'];
    $addr = $_POST['addr'];

    $query = "INSERT INTO `suppliers` VALUES (NULL,'$suppName','$addr',$phone) ";
    //echo $query;
    $res = mysqli_query($con,$query);
    if($res){
        //success message
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                text: 'Supplier added successfully!'
            });
            $('#form').trigger('reset');
        </script>
        ";
    }else{
        //falied message
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                text: 'Something is worng!'
            });
            $('#form').trigger('reset');
        </script>
        ";
    }
}
?>