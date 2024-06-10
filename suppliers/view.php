<?php 
include_once "../components/header.php"; 

if($_SESSION['lst']!=true){
    header("location:/grocery/index.php");
}
$pid = $_GET['supplier'];
?>
    <title>GMS | View Supplier</title>
</head>
<body class="m-0 p-0">
    <div class="row" style="height: 100vh;">
        <div class="col bg-cmn pe-3 h-100 align-items-center pt-5"><center>
            <div class="p-2 pt-5 h-90 w-50">
                <div class="border border-dark rounded h-100 p-5 bg-white">
                    <div class="d-flex flex-row">
                        <div class="tile bg-white text-dark shadow-toon w-100">
                            <p class="fs-3 pb-3 border-bottom border-dark"><strong>
                                View Supplier</strong>
                            </p>
                            <form action="">
                                <?php
                                $pquery = "SELECT * FROM `suppliers` WHERE id = $pid ";
                                $pres = mysqli_query($con,$pquery);
                                $pdata = mysqli_fetch_array($pres)
                                ?>
                                <table class="table border border-white">
                                    <tr>
                                        <td>Supplier Name</td>
                                        <td colspan="2">
                                        <input type="text" value="<?php echo $pdata['s_name']; ?>" id="supp"
                                        class="col p-2 ps-3 rounded border  w-100"
                                        placeholder="product name">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Phone no.</td>
                                        <td colspan="2"><input class="w-100 border border-dark rounded ps-3 p-2" type="text" id="phone" onkeypress="return event.charCode>=48 && event.charCode<=57"
                                        value="<?php echo $pdata['phone']; ?>" placeholder="" minlength="10">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td colspan="2"><textarea class="rounded border border-dark w-100 p-2 px-3" id="addr" cols="30" rows="2"><?php echo $pdata['address'].""; ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><a href="./" class="btn btn-outline-warning shadow">Back</a></td>
                                        <td><button class="btn btn-outline-danger shadow w-100" id="del">Delete</button></td>
                                        <td><button type="submit" class="btn btn-primary w-100 shadow" id="update">Update</button></td>
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
    $("#update").click(function(e){
        e.preventDefault();
        let id = <?php echo $pid; ?>;
        let supp = $("#supp").val();
        let phone = $("#phone").val();
        let addr = $("#addr").val();
        let action = 'update';
        //console.log(cate);
        $.ajax({
            url: "../suppliers/updateSupplier.php",
            type: "POST",
            data: {id:id, supp:supp, phone:phone, addr:addr, action:action},
           // contentType: false,
			//processData: false,
            success: function(res){
                console.log(res);
                if(res==1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Supplier has been updated'
                    });
                }else{
                    Swal.fire({
                        icon: 'warning',
                        title: 'Something is wrong'
                    });
                }
            }
        });
    });
    $("#del").click(function(e){
        e.preventDefault();
        let id = <?php echo $pid; ?>;
        let action = 'remove';
        //console.log(cate);
        $.ajax({
            url: "../suppliers/updateSupplier.php",
            type: "POST",
            data: {id:id, action:action},
           // contentType: false,
			//processData: false,
            success: function(res){
                console.log(res);
                if(res=='1'){
                    Swal.fire({
                        icon: 'success',
                        title: 'Supplier has been deleted',
                        showConfirmButton: true
                    }).then((result) => {
                        
                        if(result.isConfirmed){
                            location.href = "./";

                        }
                    });
                }else{
                    Swal.fire({
                        icon: 'warning',
                        title: 'Something is wrong'
                    });
                }
            }
        });
    });
});
</script>
</html>