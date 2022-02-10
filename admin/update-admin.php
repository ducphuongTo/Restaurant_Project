<?php
include('partials/menu.php');
?>

<div class="main-content">
          <div class="wrapper">
                    <h1>Update admin</h1>
                    <br><br>
                    <?php
                    //1. get the id of selected admin
                    $id = $_GET['id'];
                    //2. create sql query to get the details
                    $sql = "SELECT * FROM tbl_admin WHERE id =$id";

                    $res = mysqli_query($conn, $sql);

                    if ($res == true) {
                              $count = mysqli_num_rows($res);
                              if ($count == 1) {
                                        $row = mysqli_fetch_assoc($res);

                                        $full_name = $row['full_name'];
                                        $username = $row['username'];
                              } else {
                                        header("location:" . SITEURL . 'admin/manage-admin.php');
                              }
                    }
                    ?>
                    <form action="" method="POST">
                              <table class="tbl-30">
                                        <tr>
                                                  <td>Full Name:</td>
                                                  <td><input type="text" name="full_name" placeholder="Enter your name" value="<?php echo $full_name; ?>"></td>
                                        </tr>
                                        <tr>
                                                  <td>User Name:</td>
                                                  <td><input type="text" name="username" placeholder="Enter username" value="<?php echo $username; ?>"></td>
                                        </tr>

                                        <tr>
                                                  <td colspan="2">
                                                            <input type="hide" name="id" value="<?php echo $id; ?>">
                                                            <input type="submit" name="submit" value="Update admin" class="btn-admin">
                                                  </td>


                                        </tr>
                              </table>
                    </form>
          </div>
</div>

<?php
//check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
          //get all the values from form to update
          $id = $_POST['id'];
          $full_name = $_POST['full_name'];
          $username = $_POST['username'];

          //create a sql query to update 
          $sql = "UPDATE tbl_admin SET
                    full_name = '$full_name',
                    username = '$username'
                    WHERE id = $id
           ";

          $res = mysqli_query($conn, $sql);

          //check whether the query success or not
          if ($res == TRUE) {
                    $_SESSION['update'] = "<div class = 'success'>Admin Update successfully </div>";
                    header("location:" . SITEURL . 'admin/manage-admin.php');
          } else {
                    $_SESSION['update'] = "<div class = 'error'>Fail to update admin </div>";
                    header("location:" . SITEURL . 'admin/manage-admin.php');
          }
}
?>

<?php
include('partials/footer.php');
?>