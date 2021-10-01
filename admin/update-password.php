<?php include('login-check.php'); ?>
<?php include('partials/menu.php'); ?>
<?php include('partials/constants.php'); ?>
<div class="content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br/><br/>
        <?php
            $id = $_GET['id'];
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password"/>

                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password"/>
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>"/>
                        <input class="btn-secondary" type="submit" name="submit" value="Change Password"/>
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
<?php

    if(isset($_POST['submit'])){
        //get data
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //check the user if the id and the password are same
        $sql = "SELECT * FROM tbl_admin WHERE id = '$id' AND password = '$current_password'";

        //execute query
        $res = mysqli_query($conn,$sql);
        if($res == TRUE){
            $count = mysqli_num_rows($res);
            
            //Check user is exists or not
            if($count == 1){
                // user exist
                if($new_password == $confirm_password){
                    //update
                    $sql2 = "UPDATE tbl_admin SET
                        password = '$new_password'
                        WHERE id = $id
                        ";
                    $res2 = mysqli_query($conn,$sql2); 
                    if($res2 == TRUE){
                        //success
                        echo "ok!";
                        $_SESSION['change-pwd'] = "<div class='success'> Password changed successfuly!</div>";
                        header("location:".SITEURL."admin/manage-admin.php");
                    }else{
                        //failed
                        $_SESSION['password-not-match'] = "<div class='error'> error!</div>";
                        header("location:".SITEURL."admin/manage-admin.php");
                    }
                }else{
                    //redirect with error message
                    $_SESSION['password-not-match'] = "<div class='error'> Password dont match!</div>";
                    header("location:".SITEURL."admin/manage-admin.php");
                }
            }else{
                // user doesnt exist
                $_SESSION['user-not-found'] = "<div class='error'> User not found!</div>";
                header("location:".SITEURL."admin/manage-admin.php");
            }
        }
        //

    }

?>
<?php include('partials/footer.php'); ?>