<?php 
include_once "../components/connection.php"; 
$_SESSION['page'] = "Login";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'>
    <!--<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-bulma/bulma.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="../media/shopping-bag.png">
    <script src="/grocery/js/query.min.js"></script>
    <title>GMS | Login</title>
</head> 
<body class="container-fluid bg-cmn">
    <div class="row" style="height: 100vh;">
    <center class="position-absolute" style="top: 25%;">
        <h1 class="text-dark fs-2 fw-bold">ADMIN LOGIN</h1>
        <form action="" method="POST" class="shadow w-100 bg-white p-4 rounded" style="max-width: 500px;">
            <table class="table">
                <tr>
                    <td class="border-0 mb-2"><label for="" class="px-3 py-1 text-start">User Id</label></td>
                    <td class="border-0 mb-2 col row"><input type="text" name="id" id="id" class="w-100 px-3 rounded border-1 border-dark py-2 shadow mb-2" reqired></td>
                </tr>
                <tr>
                    <td class="border-0">
                        <label for="" class="px-3 py-1 text-start">Password</label>
                    </td>
                    <td class="border-0 col row">
                        <div class="input-group px-0 border border-dark rounded w-100">
                            <input type="password" name="pwd" id="pwd" class="px-3 border-0 form-control rounded-start py-2 shadow" reqired>
                            <button class="btn border-start pt-2 rounded-end bg-light" type="button" id="vis">
                                <i class="fi fi-sr-eye"></i>
                            </button>
                            <button class="btn border-start rounded-end pt-2 bg-light" type="button" id="hid">
                                <i class="fi fi-sr-eye-crossed"></i>
                            </button>
                        </div> 
                    </td>
                </tr>
            </table>
            <a href="./reset-password.php" class="text-primary py-2"><center>Forgot Password</center></a>
            <br>
            <input type="submit" class="btn btn-outline-success w-100" value="login" name="submit">
        </form>
    </center>
    </div>
</body>
<script>
//$(document).ready(function(){
        $("#id").val("");
        $("#pwd").val("");
    $("#hid").hide();
    $("#vis").click(function(){
        $("#pwd").attr("type","password");
        $("#vis").hide();
        $("#hid").show();
    });
    $("#hid").click(function(){
        $("#pwd").attr("type","text");
        $("#hid").hide();
        $("#vis").show();
    });
//});
</script>
</html>
<?php

include_once "../components/connection.php";

session_start();
if($_SESSION['message']=='upp'){
    echo "
        <script>
        Swal.fire({
            icon: 'success',
            text: 'Password updated successfully!'
            cofirmButtonText: 'Done'
        });
        </script>
    ";
    
}
$_SESSION['message'] = '';

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $pwd = $_POST['pwd'];
    $query = "SELECT * FROM `admin` WHERE id = $id ";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_array($result);
        if(openssl_decrypt($data['pwd'], "AES-128-ECB", SECRETKEY) == $pwd){
            //login
            $_SESSION['user'] = "admin";
            $_SESSION['id'] = $id;
            $_SESSION['lst'] = true;
            $_SESSION['message'] = 'go';
            header("location: ../dashboard/");
        }else{
            //wrong password
            echo "
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Wrong password!',
                cofirmButtonText: 'Retry'
            });
            </script>
            ";
        }
    }else{
        //incorrect user id
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Incorrect user id!',
            cofirmButtonText: 'Retry'
        });
        </script>
        ";
    }

}
?>