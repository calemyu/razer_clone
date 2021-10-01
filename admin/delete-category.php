<?php include('partials/constants.php'); ?>
<?php
    //echo "deletepage";
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        //remove file
        if($image_name !=""){
            $path = "../img/category/$image_name";
            $remove = unlink($path);
            if($remove == FALSE){
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
                header("location:".SITEURL."admin/manage-category.php");
                die();
            }
        
        }

        
        //remove data from database
        $sql = "DELETE FROM tbl_category WHERE id = $id";
        $res = mysqli_query($conn,$sql);
        if($res == TRUE){
            $_SESSION['delete'] = "<div class='success'>Category deleted!</div>";
            header("location:".SITEURL."admin/manage-category.php");
        }else{
            $_SESSION['delete'] = "<div class='error'>Category delete failed!</div>";
            header("location:".SITEURL."admin/manage-category.php");
        }
        //redirect
    }else{
        header("location:".SITEURL."admin/manage-category.php");
    }
?>
