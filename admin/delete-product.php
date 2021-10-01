<?php include('partials/constants.php'); ?>
<?php 
    
    if(isset($_GET['id']) AND isset ($_GET['image_name'])){
        //get Data
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        //delete image if there is image file
        if($image_name != ""){
            //get path
            $path = "../img/product/".$image_name;
            //delete image
            $remove = unlink($path);
            if($remove == FALSE){
                $_SESSION['upload'] = "<div class='error'>Failed to remove image</div>";
                header("location:".SITEURL.'admin/manage-product.php');
                die();
            }
        }
        // Delete product from database
        $sql = "DELETE FROM tbl_product WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if($res == TRUE){
            $_SESSION['delete'] = "<div class='success'>deleted successfully</div>";
            header('location:'.SITEURL.'admin/manage-product.php');
        }else{
            $_SESSION['delete'] = "<div class='error'>deleted failed</div>";
            header('location:'.SITEURL.'admin/manage-product.php');
        }

    }else{
        //redirect
        $_SESSION['unauthorize'] = "<div class='error'> Unauthorized access</div>";
        header("location: ".SITEURL.'admin/manage-product.php');
    }

?>