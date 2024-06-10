<div class="nav-loc d-flex flex-row justify-content-between">
    <div class="d-flex flex-row align-items-center">
        <div>
            <img src="../media/left.png" width="20px">
        </div>
        <p class="ps-3 m-0"><?php echo $_SESSION['page']; ?></p>
    </div>

    <div class="col-6 d-flex flex-row justify-content-end dropdown">
        <div class="px-3 w-100" style="max-width: 400px;">
            <?php
            $query = "SELECT id FROM `product` WHERE available>=0 AND available<min_req ";
            $res = mysqli_query($con,$query);
            if(mysqli_num_rows($res) != 0){
            ?>
            <div class="bg-white bg-opacity-50 border border-dark px-1 rounded">
                <marquee behavior="scroll" scrolldelay="250ms" direction="left" class="text-danger h-100 fw-bold fs-5" style="letter-spacing: 1px;">
                products needed</marquee>
            </div>
            <?php } ?>
        </div>
        <div type="button" data-bs-toggle="dropdown" aria-expanded="false"  >
            <img class="border border-2 border-dark rounded-circle p-1 shadow scl-12" 
                src="../media/avatar.png"  alt="" width="36px">
        </div>
        <p class="m-0 ps-3 fs-4" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['user']; ?></p>
        <ul class="dropdown-menu border-dark border-2 shadow">
            <li><a class="dropdown-item" href="../profile/">Profile</a></li>
            <li><button class="dropdown-item" id="lgout2">Logout</button></li>
        </ul>

    </div>
</div>
<hr class="my-3">