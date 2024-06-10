<?php 
session_start();
if($_SESSION['lst']!=true){
    header("location:/grocery/index.php");
}
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

    <title>GMS | Add Orders</title>
</head>
<body class="m-0 p-0">
    <div class="row" style="height: 100vh;">
        <div class="col bg-cmn pe-3 h-100 align-items-center pt-5"><center>
            <div class="p-2 h-90 w-75 ">
                <div class="border border-dark rounded h-100 p-5 bg-white">
                    <div class="d-flex flex-row">
                        <div class="tile bg-white text-dark shadow-toon w-100 row overflow-auto vh-75 p-0">
                            <div class="col-12 fs-3 pb-3 pt-4 m-0 sticky-top shadow bg-white border-bottom border-2 border-dark">
                                <strong>Add Order</strong>
                            </div>
                            <?php
                            if($_SESSION['message']!=''){
                                echo $_SESSION['message'];
                                $_SESSION['message'] = '';
                            }
                            ?>
                            <div class="d-flex flex-column p-5 pt-5 bg-secondary-subtle">
                                <div class="row bg-white border p-3 pt-4 pb-4 rounded-3 shadow">
                                    <p class="fs-5 bg-light">customer details</p>
                                    <label for="" class="col-12 text-start ps-0">Phone No</label>
                                    <input type="text" class="col-3" onkeypress="return event.charCode>=48 && event.charCode<=57" 
                                    id="phone" list="phnlist" required>
                                    <datalist id="phnlist">
                                        <!--old customers phone no.s-->
                                    </datalist>
                                    <div class="col-2"><button class="btn btn-secondary w-100" id="fetch">Fetch</button></div>
                                    <span class="col-7"></span>
                                    <label for="" class="col-3 text-start ps-0 pt-3">Name</label>
                                    <label for="" class="col-3 text-start ps-0 pt-3">Address</label><span class="col-6"></span>
                                    <input type="text" class="col-3 py-1" name="name" id="name" required>
                                    <input type="text" class="col-4 py-1" name="addr" id="addr">
                                    <div class="col-2"><button class="btn btn-primary w-100" id="addCust">Add</button></div>
                                </div>
                                <span class="p-3"></span>
                                <div class="row pt-4 bg-white p-3 rounded-3 shadow">
                                    <p class="fs-5 bg-light shadow shadow-sm">sales</p>
                                    <label for="" class="col-4 text-start">Product</label>
                                    <label for="" class="col-2 text-start">Quantity</label>
                                    <span class="col-6"></span>
                                    <input type="text" class="col-4" id="product" list="pList">
                                    <datalist id="pList">
                                        <!--products-->
                                    </datalist>
                                    <input type="text" class="col-2" maxlength="2" onkeypress="return event.charCode>=48 && event.charCode<=57" id="quan" list="fraqList">
                                    <datalist id="fraqList">
                                        <option value="0.75">0.75</option>
                                        <option value="0.5">0.5</option>
                                        <option value="0.25">0.25</option>
                                    </datalist>
                                    <div class="col-2"><button class="btn btn-outline-primary w-100 border-2" id="addP">add to list</button></div>
                                    <span class="p-3"></span>
                                    <hr>
                                    
                                <!--data row-->
                                    <form action="./payment.php" method="post">
                                        <table class="table" id='bilTab'>
                                            <input type="hidden" name="cid" id='cid'>
                                            <tr class="border-bottom border-dark">
                                                <th for="" class="text-start py-1">Products</th>
                                                <th for="" class="text-center py-1">Quantity</th>
                                                <th for="" class="text-center py-1">Price</thg>
                                                <th for="" class="text-center py-1">Amount</th>
                                                <th colspan="2"></th>
                                            </tr>

                                            <tfoot>
                                                <tr>
                                                    <td class="px-5"><input type="hidden" name="pmeth" id="pmeth"></td>
                                                    <td></td>
                                                    <td class="text-end">Total</td>
                                                    <td class="text-end d-flex flex-row">
                                                        <input type="text" id="totp" class="border-0 text-end w-100" value="" readonly> Rs
                                                    </td>
                                                    <td class="px-5"></td>
                                                </tr>
                                            </tfoot>

                                        </table>
                                        <!--total part-->
                                        <table class="table">
                                            <tr>
                                                <td colspan="4" class="p-3 text-center">
                                                    <input type="hidden" id="plabel" class="p-1 bg-light fw-bold border-0 rounded text-primary text-center w-100">
                                                </td>
                                            </tr>
                                            <tr>   
                                                <td class="px-5"></td>
                                                <td><a href="../" class="btn btn-outline-danger">Back</a></td>
                                                <td>
                                                    <input type="button" class="btn btn-primary w-100 shadow" id="selPay" value="Payment method">
                                                </td>
                                                <td class="px-5">
                                                    <input type="Submit" class="btn btn-success w-100 shadow" id="finSub" name="finSub" value="Pay" style="display: none;">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div></center>
        </div>
    </div>
</body>

<script>
$(document).ready(function(){
    $('#totp').val('');
    $("#selPay").click(async function(){
        const { value: paymeth } = await Swal.fire({
        title: 'Select field validation',
        input: 'select',
        inputOptions: {
            'card': 'card',
            'cash': 'cash',
            'upi': 'upi'
        },
        inputPlaceholder: 'Select a payment method',
        showCancelButton: true
        })

        if (paymeth) {
            document.getElementById("pmeth").value = paymeth;
            //document.getElementById("selPay").setAttribute("style","display:none;");
            document.getElementById("finSub").setAttribute("style","display:block");
            document.getElementById("plabel").setAttribute("type","text");
            document.getElementById("plabel").value = "Payment method selected : "+paymeth;
        }else{
            document.getElementById("selPay").setAttribute("style","display: block");
            document.getElementById("submit").setAttribute("style","display: none");
            document.getElementById("pmeth").value = paymeth;
        }
    });

    $("#phone").on("input", function(){
        const num = $(this).val();
        console.log(num);
        const dType = "datalist";
        $.ajax({
            url: "phoneNumList.php",
            type: "POST",
            data: {num:num, dType:dType},
            success: function(res){
                //$("#phnlist").innerHTML = res;
                $("#phnlist").children("option").remove();
                $("#phnlist").append(res);
                console.log($("#phnlist"));
            }
        });
    });

    $("#fetch").click(function(e){
        e.preventDefault();
        const num = $("#phone").val();
        const dType = "fetch";
        $.ajax({
            url: "phoneNumList.php",
            type: "POST",
            data: {num:num, dType:dType},
            success: function(res){
                if(res!=0){
                    const arr = res.split("/");
                    console.log(arr[0]);
                    console.log(arr[1]);
                    $("#name").val(arr[0]);
                    $("#addr").val(arr[1]);
                    $("#cid").val(arr[2]);
                    $("#name").attr("readonly","true");
                    $("#addr").attr("readonly","true");
                    $("#addCust").hide();
                }else{
                    console.log(res);
                    $("#name").val('');
                    $("#addr").val('');
                    $("#name").removeAttr("readonly");
                    $("#addr").removeAttr("readonly");
                    $("#addCust").show();
                }
            }
        });
    });
    $("#addCust").click(function(e){
        e.preventDefault();
        const num = $("#phone").val();
        const name = $("#name").val();
        const addr = $("#addr").val();
        const dType = "newCust";
        $.ajax({
            url : "phoneNumList.php",
            type: "post",
            data: {num:num, addr:addr, name:name, dType:dType},
            success: function(res){
                if(res!=''){
                    //const arr = res.split("/");
                    $('#cid').val(res);
                    Swal.fire({
                        icon: 'success',
                        title: 'New Customer added'
                    });
                }else{
                    Swal.fire({
                        icon: 'success',
                        title: 'New Customer added'
                    });
                }
            }
        });
    });

    $("#product").on("input", function(){
        const pName = $("#product").val();
        $.ajax({
            url: "products.php",
            type: "POST",
            data: {pName:pName},
            success: function(res){
                console.log(res);
                $("#pList").children("option").remove();
                $("#pList").append(res);
            }
        });
    });

    $('#addP').click(function(e){
        e.preventDefault();
        const product = $('#product').val();
        const arr = product.split(" | ");
        const pId = arr[1];
        const quan = $('#quan').val();
        console.log(pId);
        $.ajax({
            url: "products.php",
            type: "POST",
            data: {pId:pId,quan:quan},
            success: function(res){
                const arr2 = res.split("^~^");
                $('#product').val('');
                $('#quan').val('');
                $('#bilTab').append(arr2[0]);
                let totp = $('#totp').val() - 0;
                let newM = arr2[1] - 0;
                totp = totp + newM;
                console.log(totp);
                $('#totp').val(totp.toString());

            }      
        });
    });
    $("#bilTab").on("click", "#remv" ,function(){
        const newM = $(this).closest('tr').children('td').children('input#amn').val() - 0;;
        let totp = $('#totp').val() - 0;
        totp = totp - newM;
        console.log(totp);
        $('#totp').val(totp.toString());
        $(this).closest('tr').remove();
    });
});
</script>
</html>