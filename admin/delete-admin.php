<?php include('partials/constants.php'); ?>
<?php
    //get id to delete admin
    $id = $_GET['id'];


    // create query
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    //execute query
    $res = mysqli_query($conn ,$sql);
    // check
    if($res == TRUE){
        echo "ok!";
        $_SESSION['delete'] = "Admin deleted!";
        //redirect
        header('location:'.SITEURL.'admin/manage-admin.php');

    }else{
        echo "not ok!";
        $_SESSION['delete'] = "Admin delete failed!";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
?>