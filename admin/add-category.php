<?php include('partials/menu.php'); ?>
<?php include('login-check.php'); ?>
<?php include('partials/constants.php'); ?>
<div class="content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php
        
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="name" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['submit'])){
                //echo "clicked";
                $title = $_POST['title'];
                
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }else{
                    $featured = "No";
                }
                
                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }else{
                    $active = "No";
                }

                
                if(isset($_FILES['image']['name'])){
                    //upload
                    $image_name= $_FILES['image']['name'];
                    
                    //upload image only if image is selected
                    if($image_name != ""){

                        //auto rename image
                        //get the extension (jpg,png)
                        $ext = end(explode('.',$image_name));
                        //rename
                        $image_name ="product_Category_".rand(000,999).'.'.$ext; //product_Category_834.jpg
                        
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../img/category/".$image_name;
                        $upload = move_uploaded_file($source_path, $destination_path);
                        if($upload == FALSE){
                            $_SESSION['upload'] = "<div class='error'>Failed upload!</div>";
                            header("location:".SITEURL."admin/add-category.php");
                            die();
                        }
                    }
                
                }else{
                    $image_name="";
                }
                
                $sql = "INSERT INTO tbl_category (title,image_name,featured,active) 
                        VALUES ('$title','$image_name','$featured','$active')";

                $res = mysqli_query($conn,$sql);

                if($res == TRUE){
                    //echo "sucess!";
                    $_SESSION['add'] = "<div class='success'> category added successfully. </div>";
                    header("location:".SITEURL."admin/manage-category.php");
                }else{
                    //echo "failed!";
                    $_SESSION['add'] = "<div class='success'> category added failed. </div>";
                    header("location:".SITEURL."admin/add-category.php");

                }
            }
            
        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>