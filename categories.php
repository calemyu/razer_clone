<?php include('partials-front/menu.php'); ?>
<section class="categories">
    <div class="container">

        <?php
        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
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
                            echo "<div class='error'>Image not found</div>";
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
            echo "<div class='error'>Category not found </div>";
        }


        ?>
        

    </div>
    <div class="clearfix"></div>
</section>

<?php include('partials-front/footer.php'); ?>