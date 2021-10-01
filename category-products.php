<?php include('partials-front/menu.php'); ?>
<?php
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql = "SELECT title FROM tbl_category WHERE id = $category_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $category_title = $row['title'];
} else {
    header("location:" . SITEURL);
}

?>
<section class="shop">
    <div class="container">
        <?php
        $sql2 = "SELECT * FROM tbl_product WHERE category_id = $category_id";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);
        if ($count2 > 0) {
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];
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
                        <p class="food-price"><?php echo $price; ?></p>
                        <p class="food-detail"><?php echo $description; ?></p>
                        <br>
                        <a href="" class="btn-primary">Order now</a>
                    </div>
                    <div class="clearfix"></div>
                </div>



        <?php
            }
        }

        ?>




        <div class="clearfix"></div>
    </div>

</section>


<?php include('partials-front/footer.php'); ?>