<?php
include('partials/menu.php');
?>

<div class="main-content">
          <div class="wrapper">
                    <h1>Add Admin</h1>
                    <?php
                    if (isset($_SESSION['add'])) {
                              echo $_SESSION['add'];
                              unset($_SESSION['add']);
                    }
                    ?>
                    <form action="" method="POST">
                              <table class="tbl-30">
                                        <tr>
                                                  <td>Full Name:</td>
                                                  <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                                        </tr>
                                        <tr>
                                                  <td>User Name:</td>
                                                  <td><input type="text" name="username" placeholder="Enter username"></td>
                                        </tr>
                                        <tr>
                                                  <td>Password:</td>
                                                  <td><input type="password" name="password" placeholder="Enter password"></td>
                                        </tr>
                                        <tr>
                                                  <td colspan="2">
                                                            <input type="submit" name="submit" value="Add admin" class="btn-admin">
                                                  </td>


                                        </tr>
                              </table>
                    </form>
          </div>
</div>

<?php
include('partials/footer.php');
?>

<?php
//xử lý form và lưu vào DB
if (isset($_POST['submit'])) {
          $full_name = $_POST['full_name'];
          $username = $_POST['username'];
          $password = md5($_POST['password']);

          $sql = "INSERT INTO tbl_admin set
                    full_name = '$full_name',
                    username = '$username',
                    password = '$password'
          ";
          $res = mysqli_query($conn, $sql);

          //4. check whether the data is inserted or not 
          if ($res == true) {
                    //create a session variable to display message
                    $_SESSION['add'] = "<div class = 'success'>Admin added successfully </div>";

                    //redirect page TO manager admin
                    header("location:" . SITEURL . 'admin/manage-admin.php');
          } else {
                    //fail to inserted data
                    $_SESSION['add'] = "Admin added successfully";
                    //redirect page TO add admin
                    header("location:" . SITEURL . 'admin/add-admin.php');
          }
}

?>