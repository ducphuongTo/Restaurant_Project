<?php
include('partials/menu.php');
?>
<div class="main-content">
          <div class="wrapper">
                    <h1>Change password</h1>
                    <br><br>
                    <?php
                    if (isset($_GET['id'])) {
                              $id = $_GET['id'];
                    }
                    ?>
                    <form action="" method="POST">
                              <table class="tbl-30">
                                        <tr>
                                                  <td>Old Password:</td>
                                                  <td><input type="password" name="current_password" placeholder="Enter your old password" value="<?php echo $full_name; ?>"></td>
                                        </tr>
                                        <tr>
                                                  <td>New Password:</td>
                                                  <td><input type="password" name="new_password" placeholder="Enter your new password" value="<?php echo $username; ?>"></td>
                                        </tr>
                                        <tr>
                                                  <td>Confirm password:</td>
                                                  <td><input type="password" name="confirm_password" placeholder="Enter your new password again" value="<?php echo $username; ?>"></td>
                                        </tr>

                                        <tr>
                                                  <td colspan="2">
                                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                            <input type="submit" name="submit" value="Change password" class="btn-admin">
                                                  </td>


                                        </tr>
                              </table>
                    </form>
          </div>
</div>
<?php
//check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
          //1. get the data from form
          $id = $_POST['id'];
          $current_password = md5($_POST['current_password']);
          $new_password = md5($_POST['new_password']);
          $confirm_password = md5($_POST['confirm_password']);
          //2. check whetther the user with current id and current password exists or not
          $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password = '$current_password'";

          $res = mysqli_query($conn, $sql);
          if ($res == true) {
                    $count = mysqli_num_rows($res);

                    if ($count == 1) {
                              if ($new_password == $confirm_password) {
                                        //update password

                                        $sqlUpdate = "UPDATE tbl_admin SET password = '$new_password' WHERE id = $id ";
                                        $resUpdate = mysqli_query($conn, $sqlUpdate);
                                        if ($resUpdate == true) {
                                                  $_SESSION['change-pwd'] = "<div class = 'success'>Update password successfully</div>";

                                                  header("location:" . SITEURL . 'admin/manage-admin.php');
                                        } else {
                                                  $_SESSION['change-pwd'] = "<div class = 'error'>Fail to update password</div>";

                                                  header("location:" . SITEURL . 'admin/manage-admin.php');
                                        }
                              } else {
                                        $_SESSION['pwd-not-match'] = "<div class = 'error'>Password dit not match</div>";

                                        header("location:" . SITEURL . 'admin/manage-admin.php');
                              }
                    } else {
                              $_SESSION['user-not-found'] = "<div class = 'error'>User not found</div>";

                              header("location:" . SITEURL . 'admin/manage-admin.php');
                    }
          }
          //3. check whether the new password and confirm password match or not
          //4. check password if all above is true
}
?>
<?php
include('partials/footer.php');
?>