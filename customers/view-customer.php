<?php 
include_once "../components/header.php"; 
//get page number
if(isset($_GET['pg'])){
    $pg = $_GET['pg'];
}else{
    $pg = 1;
}
$cid = $_GET['customer'];
$data = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `customer` WHERE id = $cid "));
$_SESSION['page'] = 'Customers';
?>
    <title>CMS | View Customers</title>
</head>
<body class="m-0 p-0">
    <div class="row" style="height: 100vh;">
        <div class="col bg-cmn pe-3 h-100 align-items-center pt-5"><center>
            <div class="p-2 pt-5 h-90 w-50 ">
                <div class="border border-dark rounded h-100 p-5 bg-white">
                    <div class="d-flex flex-row">
                        <div class="tile bg-white text-dark shadow-toon w-100">
                            <p class="fs-3 pb-3 border-bottom border-dark"><strong>
                                View Customer</strong>
                            </p>
                            <form action="" method="post" id="form">
                                <table class="table border border-white">
                                    <tr>
                                        <td scope="col">Name</td>
                                        <td scope="col">
                                            <input type="text" class="col p-2 ps-3 rounded border border-dark w-100" name="name" value="<?php echo $data['name']; ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col">Phone no.</td>
                                        <td scope="col">
                                            <input class="col p-2 ps-3 rounded border bg-white border-dark w-100" name="phone" value="<?php echo $data['phone']; ?>"
                                            onkeypress="return event.charCode>=48 && event.charCode<=57" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td><textarea class="rounded border border-dark w-100 p-2 ps-3" name="addr" cols="30" rows="2" 
                                        placeholder="optional"><?php echo $data['address']; ?> </textarea></td>
                                    </tr>
                                    <tr>
                                        <td><a href="./" class="btn btn-outline-danger">Back</a></td>
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

<?php 
include_once "../../components/connection.php";

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $addr = $_POST['addr'];
    if($addr == ''){ 
        $addr = 'NULL'; 
    }

    $query = "UPDATE `customer` SET `name` = '$name', `address` = '$addr' WHERE phone = $phone ";

    //$check = "SELECT * FROM `customer` WHERE `phone` = $phone ";
    if (mysqli_query($con,$query)){
        //success message
        echo "<script>
            Swal.fire({
                icon: 'success',
                text: 'customer data updated',
                showConfirmButton: false
            });
            $('#form').reset();
            </script>";
    }else{
        //failed message
        echo "<script>
            Swal.fire({
                icon: 'error',
                text: 'something is wrong',
                showConfirmButton: false
            });
            $('#form').reset();
            </script>";
    } 
}
?>
</body>
</html>