<?php include('partials-front/menu.php'); ?>

<section class="bigimage1">
    <div class="container">
        <h1 class="text-center">究極のゲーミングノートPC</h1>
        <div class="big-svg-logo text-center">
            <img src="img/Razer_Inc.-Logo.wine-cropped.svg" alt="">
        </div>
    </div>
</section>

<section class="categories">
    <div class="container">
        <?php
        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
                <a href="<?php echo SITEURL; ?>category-products.php?category_id=<?php echo $id;?>">
                    <div class="category float-container">
                        <?php
                        if ($image_name == "") {
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>img/category/<?php echo $image_name; ?>" alt="Keyboard" class="img-responsive">
                        <?php
                        }
                        ?>

                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>
        <?php



            }
        } else {
            echo "No Category";
        }

        ?>


    </div>
    <div class="clearfix"></div>
</section>

<section class="shop">
    <div class="container">
        <?php
        $sql2 = "SELECT * FROM tbl_product WHERE active ='Yes' AND featured = 'Yes' LIMIT 6";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res2)) {
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
        ?>
                <div class="shop-product-box">
                    <div class="product-img">
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'> Image not available</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>img/product/<?php echo $image_name; ?>" alt="Razer Death Adder" class="img-responsive">
                        <?php

                        }

                        ?>

                    </div>
                    <div class="product-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">¥<?php echo $price; ?></p>
                        <p class="food-detail"><?php echo $description; ?></p>
                        <br>
                        <a href="" class="btn-primary">注文する</a>
                    </div>
                    <div class="clearfix"></div>
                </div>

        <?php
            }
        } else {
            echo "<div class='error'>Product Not Available</div>";
        }

        ?>

        <div class="clearfix"></div>
    </div>

</section>
<section class="video">
    <div class="container">
        <div class="razer-video">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/kfFHghqiIAU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>