<?php include('login-check.php'); ?>
<?php include('partials/menu.php'); ?>
<?php include('partials/constants.php'); ?>
<div class="content">
    <div class="wrapper">
        <h1>Update Product</h1>
        <br><br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //sql query
            $sql2 = "SELECT * FROM tbl_product WHERE id=$id";
            $res2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($res2);
            //get values
            $title = $row2['title'];
            $description = $row2['description'];
            $price = $row2['price'];
            $current_image = $row2['image_name'];
            $current_category = $row2['category_id'];
            $featured = $row2['featured'];
            $active = $row2['active'];
        } else {
            header("location:" . SITEURL . 'admin/manage-product.php');
        }


        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php

                        if ($current_image == "") {
                            //no image
                            echo "<div class='error'>Image not avaiable</div>";
                        } else {
                            // image avaible
                        ?>
                            <img src="<?php echo SITEURL ?>img/product/<?php echo $current_image; ?>" alt="" width="150px">
                        <?php
                        }

                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image: </td>
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
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                            ?>
                                    <option <?php if ($current_category == $category_id) {
                                                echo "Selected";
                                            } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
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
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td> Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Product" class="btn-secondary">
                    </td>
                </tr>
            </table>


        </form>

        <?php
            if(isset($_POST['submit'])){
                //get data from form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];




                // upload image if selected

                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name']; // new imagename
                    if($image_name != ""){
                        //image available
                        //rename
                        $ext = end(explode('.',$image_name));
                        $image_name = "Product-Name-".rand(0000,9999).'.'.$ext; // renamed image file
                        //get source and destinationpath
                        $src_path = $_FILES['image']['tmp_name']; //source path
                        $dest_path = "../img/product/".$image_name; //destination path
                        //upload image
                        $upload = move_uploaded_file($src_path, $dest_path);
                        //confirm
                        if($upload == FALSE){
                            $_SESSION['upload']= "<div class='error'> !!!Failed to upload the image </div>";
                            header("location:".SITEURL."admin/manage-product.php");
                            die();
                        }
                        //delete current image
                        if($current_image != ""){
                            $remove_path ="../img/product/".$current_image;
                            $remove = unlink($remove_path);
                            if($remove == FALSE){
                                $_SESSION['remove-failed'] = "<div class='error'> remove image failed </div>";
                                header( "location:".SITEURL."admin/manage-product.php");
                                die();
                            }
                        }
                    }else{
                        $image_name = $current_image;
                    }
                    
                }else{
                    $image_name = $current_image;
                }

                
                //update product in database
                $sql3 = "UPDATE tbl_product SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = '$category',
                        featured = '$featured',
                        active = '$active'
                        WHERE id = $id;
                ";
                $res3 = mysqli_query($conn,$sql3);
                if($res3 == TRUE){
                    $_SESSION['update'] = "<div class='success'>Product updated successfully</div>";
                    header("location:".SITEURL."admin/manage-product.php");
                }else{
                    $_SESSION['update'] = "<div class='error'>Product update failed</div>";
                    header("location:".SITEURL."admin/manage-product.php");
                }

                //redirect
            }

        ?>
    </div>
</div>




<?php include('partials/footer.php'); ?>