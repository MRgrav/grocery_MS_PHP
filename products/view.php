<?php 
include_once "../components/header.php"; 
$pid = $_GET['product'];
?>
    <title>Dashboard</title>
</head>
<body class="m-0 p-0">
    <div class="row" style="height: 100vh;">
        <div class="col bg-cmn pe-3 h-100 align-items-center pt-5"><center>
            <div class="p-2 pt-5 h-90 w-50 ">
                <div class="border border-dark rounded h-100 p-5 bg-white">
                    <div class="d-flex flex-row">
                        <div class="tile bg-white text-dark shadow-toon w-100">
                            <p class="fs-3 pb-3 border-bottom border-dark"><strong>
                                View Product</strong>
                            </p>
                            <form action="">
                                <?php
                                $pquery = "SELECT * FROM `product` INNER JOIN `categories` ON product.c_id=categories.id WHERE product.id = $pid ";
                                $pres = mysqli_query($con,$pquery);
                                $pdata = mysqli_fetch_array($pres)
                                ?>
                                <table class="table border border-white">
                                    <tr>
                                        <td>Product Name</td>
                                        <td>
                                        <input type="text" value="<?php echo $pdata['p_name']; ?>" id="pname"
                                        class="col p-2 ps-3 rounded border  w-100"
                                        placeholder="product name" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Categories</td>
                                        <td>
                                        <select class="col p-2 ps-3 rounded border bg-white border-dark w-100" id="cate">
                                            <?php
                                            $query = "SELECT * FROM `categories` ";
                                            $result = mysqli_query($con, $query);
                                            while($data = mysqli_fetch_assoc($result)){
                                                if ($pdata['c_name'] == $data['c_name']){
                                                    echo "<option selected value='".$data['id']."'>".$data['c_name']."</option>";
                                                }else{
                                                    echo "<option value='".$data['id']."'>".$data['c_name']."</option>";
                                                }
                                            } ?>
                                        </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td><input class="w-100 border border-dark rounded ps-3 p-2" type="text" id="price" onkeypress="return event.charCode>=48 && event.charCode<=57"
                                        value="<?php echo $pdata['price']; ?>" placeholder="price per <?php echo $pdata['unit_type']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Unit Type</td>
                                        <td>
                                            <select class="col p-2 ps-3 rounded border bg-white border-dark w-100" id="unit">  
                                                <option <?php if($pdata['unit_type']=='pcs'){ echo "selected"; }?> value="pcs">pcs <small>(pieces)</small></option>
                                                <option <?php if($pdata['unit_type']=='ml'){ echo "selected"; }?> value="ml">ml <small>(mili litter)</small></option>
                                                <option <?php if($pdata['unit_type']=='ltr'){ echo "selected"; }?> value="ltr">ltr <small>(litter)</small></option>
                                                <option <?php if($pdata['unit_type']=='g'){ echo "selected"; }?> value="g">g <small>(gram)</small></option>
                                                <option <?php if($pdata['unit_type']=='kg'){ echo "selected"; }?> value="kg">kg <small>(killogram)</small></option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Minimum required</td>
                                        <td><input class="w-100 border border-dark rounded ps-3 p-2" type="text" id="minim" onkeypress="return event.charCode>=48 && event.charCode<=57"
                                        value="<?php echo $pdata['min_req']; ?>" placeholder="price per <?php echo $pdata['unit_type']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td><textarea class="rounded border border-dark p-2 w-100" id="descr" cols="30" rows="2"><?php if($pdata['descp']!=''){ echo $pdata['descp'].""; } ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><a href="./" class="btn btn-outline-danger">Back</a></td>
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
        let pname = $("#pname").val();
        let cate = $("#cate").val();
        let price = $("#price").val();
        let unit = $("#unit").val();
        let minim = $("#minim").val();
        let descr = $("#descr").val();
        if(descr == ''){ descr = 'null'; }
        //console.log(cate);
        $.ajax({
            url: "../products/updateProduct.php",
            type: "POST",
            data: {id:id, pname:pname, cate:cate, price:price, unit:unit, minim:minim, descr:descr},
           // contentType: false,
			//processData: false,
            success: function(res){
                console.log(res);
                if(res==1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Product has been updated'
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