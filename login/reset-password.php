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
    <title>GMS | Password recovery</title>
</head>
<body class="m-0 p-0">
<?php 
include_once "../components/connection.php"; 
session_start();
$_SESSION['page'] = "Login";
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $pwd = $_POST['npwd'];
    $pwd = openssl_encrypt($pwd, "AES-128-ECB", SECRETKEY);

    $query = "UPDATE `admin` SET pwd = '$pwd' WHERE id = $id ";
    //echo $query;
    $result = mysqli_query($con,$query);
    if($result){
        //success message
        $_SESSION['message'] = "upp";
        header("location: /grocery/login/index.php");
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
        header("location: /grocery/login/index.php");
    }
}
?>

    <div class="row" style="height: 100vh;">
        <div class="col bg-cmn pe-3 h-100 align-items-center pt-5"><center>
            <div class="p-2 pt-5 h-90 w-100" style="max-width: 700px;">
                <div class="border-0 bg-white shadow h-100 p-5">
                    <div class="d-flex flex-row">
                        <div class="bg-white text-dark w-100">
                            <p class="fs-3 pb-3 border-bottom border-dark"><strong>
                                Password Reset</strong>
                            </p>
                            <?php
                            if($_SESSION['message']!=''){
                                echo $_SESSION['message'];
                                $_SESSION['message'] = '';
                            }
                            ?>
                            <form action="" method="post">
                                <table class="table border border-white">
                                    <tr class="verdata">
                                        <td scope="col">Name</td>
                                        <td scope="col">
                                        <input type="text" class="col p-2 ps-3 rounded border border-dark w-100" id="uname"
                                            placeholder="user name" minlength="3" maxlength="50" name="name">
                                        </td>
                                    </tr>
                                    <tr class="verdata">
                                        <td>Id</td>
                                        <td><input class="w-100 border border-dark rounded ps-3 p-2" name="id" id="uid" type="text" placeholder="user id" required></td>
                                    </tr>
                                    <tr id="nextBox">
                                        <td><a href="../dashboard/" class="btn btn-outline-danger">Back</a></td>
                                        <td><button type="button" class="btn btn-primary w-100" id="next">Next</button></td>
                                    </tr>
                                    <tr class="repwd">
                                        <td scope="col">New Password</td>
                                        <td scope="col row input-group">
                                            <div class="input-group ">
                                                <input type="password" class="form-control p-2 border-dark" name="npwd" id="pwd" placeholder="">
                                                <button class="btn btn-outline-secondary border-dark" type="button" id="vis">
                                                    <i class="fi fi-sr-eye"></i>
                                                </button>
                                                <button class="btn btn-outline-secondary border-dark" type="button" id="hid">
                                                    <i class="fi fi-sr-eye-crossed"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="repwd">
                                        <td scope="col">Confirm Password</td>
                                        <td scope="col row input-group">
                                            <div class="input-group">
                                                <input type="password" class="form-control p-2 border-dark" id="ckp" placeholder="">
                                            </div>
                                            <p class="text-danger" id='err-msg'><small><span class="bg-danger shadow shadow-sm rounded px-1 me-2 text-white">error</span>not matching</small></p>
                                        </td>
                                    </tr>
                                    <tr class="repwd">
                                        <td><a href="./index.php" class="btn btn-outline-danger">Back</a></td>
                                        <td><input type="submit" class="btn btn-primary w-100 shadow" name="submit" value="Update"></td>
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
    $('.repwd').hide();
    $("#pwd").val("");
    $("#hid").hide();
    $('#err-msg').hide();
    $("#vis").click(function(){
        $("#pwd").attr("type","text");
        $("#vis").hide();
        $("#hid").show();
    });
    $("#hid").click(function(){
        $("#pwd").attr("type","password");
        $("#hid").hide();
        $("#vis").show();
    });
    $('#ckp').on("input", ()=>{
        let conf = $('#ckp').val();
        let newp = $('#pwd').val();
        if(conf == newp){
            $('#err-msg').hide();
        }else{
            $('#err-msg').show();
        }
    });
    $('#next').click(function(e){
        const id = $('#uid').val();
        const name = $('#uname').val();
        e.preventDefault();
        $.ajax({
            url: "verification.php",
            type: "post",
            data: {id:id, name:name},
            success: function(res){
                console.log(res);
                if(res==1 || res=='1'){
                    $('.repwd').show();
                    $('.verdata').hide();
                    $('#nextBox').hide();
                }else{
                    $('.repwd').hide();
                    $('.verdata').show();
                    $('#nextBox').show();
                }
            }
        });
    });
</script>
</html>