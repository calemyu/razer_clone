<?php include('partials-front/menu.php'); ?>
<section class="shop">
    <div class="container">
        <?php

        $sql = "SELECT * FROM tbl_product WHERE active ='Yes'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];
        ?>
                <div class="shop-product-box">
                    <div class="product-img">
                        <?php
                            if($image_name ==""){
                                echo "<div class='error'>image not avaiable</div>";
                            }else{
                                ?>
                                <img src="<?php echo SITEURL; ?>img/product/<?php echo $image_name; ?>" alt="Razer Death Adder" class="img-responsive">
                                <?php
                            }
                        ?>
                        
                    </div>
                    <div class="product-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="product-price"><?php echo $price; ?></p>
                        <p class="product-detail"><?php echo $description; ?></p>
                        <br>
                        <a href="" class="btn-primary">Order now</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
        <?php
            }
        } else {
            echo "<div class='error'> Product not found </div>";
        }
        ?>



        <div class="clearfix"></div>
    </div>

</section>


<?php include('partials-front/footer.php'); ?>