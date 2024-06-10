<div class="col-xl-3 col-xxl-2 col-md-4 col-sm p-4 bg-light shadow border border-dark border-2 h-100 h-sm-120" style="max-width:380px">
  <div style="height: 90%">
    <div class="p-3 border border-dark rounded rounded-4 border-3 shadow">
        <a class="navbar-brand fs-4" href="./">
          <img class="scl-12" src="../media/shopping-bag.png" alt="" width="42px">
          <b class="ps-2 pt-2">Grocery MS</b>
        </a>
    </div>
    <hr class="border-dark my-5">
    <div class="p-1">
      <ul>
        <li class="menu <?php if($_SESSION['page']=='Dashboard'){ echo 'menu-active'; } ?>">
          <i class="fi fi-sr-home <?php if($_SESSION['page']=="Dashboard"){ echo 'text-white pe-2'; } ?>"></i>
          <a class="<?php if($_SESSION['page'] == 'Dashboard'){ echo 'menu-active-font'; } ?> block ps-1" href="../dashboard/">Dashboard</a>
        </li>
        <li class="menu <?php if($_SESSION['page']=='Products'){ echo 'menu-active'; } ?>">
          <i class="fi fi-sr-cube <?php if($_SESSION['page']=='Products'){ echo 'text-white pe-2'; } ?>"></i>
          <a class="<?php if($_SESSION['page']=='Products'){ echo 'menu-active-font'; } ?> block ps-1" href="../products/">Products</a>
        </li>
        <li class="menu <?php if($_SESSION['page']=='Inventory'){ echo 'menu-active'; } ?>">
          <i class="fi fi-sr-cube <?php if($_SESSION['page']=='Inventory'){ echo 'text-white pe-2'; } ?>"></i>
          <a class="<?php if($_SESSION['page']=='Inventory'){ echo 'menu-active-font'; } ?> block ps-1" href="../inventory/">Inventory</a>
        </li>
        <li class="menu <?php if($_SESSION['page']=='Categories'){ echo 'menu-active'; } ?>">
          <i class="fi fi-sr-layers <?php if($_SESSION['page']=='Categories'){ echo 'text-white pe-2'; } ?>"></i>
          <a class="<?php if($_SESSION['page']=='Categories'){ echo 'menu-active-font'; } ?> block ps-1" href="../categories/">Categories</a>
        </li>
        <li class="menu <?php if($_SESSION['page']=='Sales'){ echo 'menu-active'; } ?>">
          <i class="fi fi-sr-basket-shopping-simple <?php if($_SESSION['page']=='Sales'){ echo 'text-white pe-2'; } ?>"></i>
          <a class="<?php if($_SESSION['page']=='Sales'){ echo 'menu-active-font'; } ?> block ps-1" href="../sales/">Sales</a>
        </li>
        <li class="menu <?php if($_SESSION['page']=='Invoices'){ echo 'menu-active'; } ?>">
          <i class="fi fi-sr-document <?php if($_SESSION['page']=='Invoices'){ echo 'text-white pe-2'; } ?>"></i>
          <a class="<?php if($_SESSION['page']=='Invoices'){ echo 'menu-active-font'; } ?> block ps-1" href="../invoices/">Invoices</a>
        </li>
        <li class="menu <?php if($_SESSION['page']=='Suppliers'){ echo 'menu-active'; } ?>">
          <i class="fi fi-sr-truck-side <?php if($_SESSION['page']=='Suppliers'){ echo 'text-white pe-2'; } ?>"></i>
          <a class="<?php if($_SESSION['page']=='Suppliers'){ echo 'menu-active-font'; } ?> block ps-1" href="../suppliers/">Suppliers</a>
        </li>
        <li class="menu <?php if($_SESSION['page']=='Customers'){ echo 'menu-active'; } ?>">
          <i class="fi fi-sr-users-alt <?php if($_SESSION['page']=='Customers'){ echo 'text-white pe-2'; } ?>"></i>
          <a class="<?php if($_SESSION['page']=='Customers'){ echo 'menu-active-font'; } ?> block ps-1" href="../customers/">Customers</a>
        </li>
      </ul>
    </div>
  </div>
  <div>
    <hr>
    <button class="w-100 btn btn-outline-danger border-2 p-3" id="lgout">Logout</button>
  </div>
</div>
<script>
  $(document).ready(function(){
    $("#lgout").click(function(){
      console.log("hey");
      Swal.fire({
        icon: 'warning',
        title: 'Logout',
        text: 'Are You Sure!',
        confirmButtonText: 'logout'
      }).then((result) => {
      if (result.isConfirmed) {
        window.location.href='/grocery/logout.php';
      }
      });
    });
    $("#lgout2").click(function(){
      console.log("hey");
      Swal.fire({
        icon: 'warning',
        title: 'Logout',
        text: 'Are You Sure!',
        confirmButtonText: 'logout'
      }).then((result) => {
      if (result.isConfirmed) {
        window.location.href='/grocery/logout.php';
      }
      });
    });
    console.log('<?php echo $_SESSION['page']; ?>');
  });
</script>
