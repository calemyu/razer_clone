<?php include('partials/menu.php'); ?>
<?php include('login-check.php'); ?>
<?php include('partials/constants.php'); ?>
<div class="content">
    <div class="wrapper">
        <h1> Add Product </h1>
        <br><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Product Title">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Product Description"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Categories available</option>
                            <?php

                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td> Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td> Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Product" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            //1.get data
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //check radio
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No"; // default
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No"; //default
            }

            //2.upload the image if selected
            //check image is clicked or not and upload only when image is selected
            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];
                if ($image_name != "") {
                    //rename image
                    //then get extension
                    $ext = end(explode('.', $image_name));
                    //then create new name
                    $image_name = "Product-Name-" . rand(0000, 9999) . '.' . $ext;
                    //upload image
                    //get the path
                    $src = $_FILES['image']['tmp_name'];
                    //upload path destination
                    $destination = "../img/product/" . $image_name;
                    //upload the image
                    $upload = move_uploaded_file($src, $destination);
                    //confirm
                    if ($upload == FALSE) {
                        $_SESSION['upload'] = "<div class='error'>image upload failed.</div>";
                        header("location:" . SITEURL . 'admin/add-product.php');
                        die();
                    }
                }
            } else {
                $image_name = ""; //default 
            }


            //3. insert data to database
            $sql2 = "INSERT INTO tbl_product SET
                        title ='$title',
                        description ='$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category,
                        featured = '$featured',
                        active = '$active'
                        ";
            $res2 = mysqli_query($conn, $sql2);
            if ($res == TRUE) {
                $_SESSION['add'] = "<div class='success'>product added successfully</div>";
                header("location:" . SITEURL . "admin/manage-product.php");
            } else {
                $_SESSION['add'] = "<div class='error'>product added failed</div>";
                header("location:" . SITEURL . "admin/manage-product.php");
            }
            //4. redirect
        }

        ?>


    </div>
</div>
<?php include('partials/footer.php'); ?>