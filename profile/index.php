<?php
include_once "../components/header.php"; 
//get page number
if(isset($_GET['pg'])){
    $pg = $_GET['pg'];
}else{
    $pg = 1;
}
$query = mysqli_query($con,"SELECT * FROM `admin` WHERE id = ".$_SESSION['id']." ");
$data = mysqli_fetch_array($query);
$oldPwd = openssl_decrypt($data['pwd'], "AES-128-ECB", SECRETKEY);
?>
    <title>GMS | Profile</title>
</head>
<body class="m-0 p-0">
    <div class="row" style="height: 100vh;">
        <div class="col bg-cmn pe-3 h-100 align-items-center pt-5"><center>
            <div class="p-2 pt-5 h-90 w-50 ">
                <div class="border border-dark rounded h-100 p-5 bg-white">
                    <div class="d-flex flex-row">
                        <div class="tile bg-white text-dark shadow-toon w-100">
                            <p class="fs-3 pb-3 border-bottom border-dark"><strong>
                                Profile</strong>
                            </p>
                            <form action="" method="post">
                                <table class="table border border-white">
                                    <tr>
                                        <td scope="col">Name</td>
                                        <td scope="col">
                                        <input type="text" class="col p-2 ps-3 rounded border border-dark w-100" value="<?php echo $_SESSION['user']; ?>"
                                            placeholder="name" name="product" minlength="3" maxlength="50" name="name" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Id</td>
                                        <td><input class="w-100 border border-dark rounded ps-3 p-2" name="id" type="text" placeholder="" value="<?php echo $_SESSION['id']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <td scope="col">Current Password</td>
                                        <td scope="col">
                                        <input type="text" class="col p-2 ps-3 rounded border border-dark w-100 text-secondary" value="<?php echo $oldPwd; ?>"
                                            placeholder="" name="product" minlength="6" maxlength="10" style="letter-spacing: 2px;" readonly>
                                        </td>
                                    </tr>
                                    <tr>
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
                                    <tr>
                                        <td scope="col">Confirm Password</td>
                                        <td scope="col row input-group">
                                            <div class="input-group">
                                                <input type="password" class="form-control p-2 border-dark" id="ckp" placeholder="">
                                            </div>
                                            <p class="text-danger" id='err-msg'><small><span class="bg-danger shadow shadow-sm rounded px-1 me-2 text-white">error</span>not matching</small></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="../dashboard/" class="btn btn-outline-danger">Back</a></td>
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
    $("#id").val("");
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
</script>
<?php 
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $id = $_POST['id'];
    $pwd = $_POST['npwd'];
    $pwd = openssl_encrypt($pwd, "AES-128-ECB", SECRETKEY);
    if($name==''){
        $name = $_SESSION['user'];
    }

    $query = "UPDATE `admin` SET `name` = '$name', pwd = '$pwd' WHERE id = $id ";
    echo $query;
    if(mysqli_query($con,$query)){
        //success message
        echo "
        <script>
        Swal.fire({
            icon: 'success',
            text: 'Profile updated successfully!'
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
</html>