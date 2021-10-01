<?php include('partials/menu.php'); ?>
<?php include('login-check.php'); ?>
<?php include('partials/constants.php'); ?>
    <div class="content">
        <div class="wrapper">
            <h1>Dashboard</h1>
            <br><br>
            <div class="col-4 text-center">
                
                <?php
                    $sql = "SELECT * from tbl_category";
                    $res = mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($res);


                ?>
                <h1><?php echo $count; ?></h1>
                <br>
                Categories
            </div>
            <div class="col-4 text-center">
            <?php
                    $sql2 = "SELECT * from tbl_product";
                    $res2 = mysqli_query($conn,$sql2);
                    $count2 = mysqli_num_rows($res2);


                ?>
            
            
                <h1><?php echo $count2; ?></h1>                
                <br>
                Products
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php include('partials/footer.php'); ?>