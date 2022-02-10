<?php
include('partials/menu.php');
?>


<!--
                    Main content section starts
          -->

<div class="main-content">
          <div class="wrapper">
                    <h1>Manage admin</h1>
                    <br> <br>
                    <!--Add admin-->
                    <?php
                    if (isset($_SESSION['add'])) {
                              echo $_SESSION['add']; //display session message
                              unset($_SESSION['add']); // removing session message
                    }
                    if (isset($_SESSION['delete'])) {
                              echo $_SESSION['delete']; //display session message
                              unset($_SESSION['delete']); // removing session message
                    }
                    if (isset($_SESSION['update'])) {
                              echo $_SESSION['update']; //display session message
                              unset($_SESSION['update']); // removing session message
                    }
                    if (isset($_SESSION['user-not-found'])) {
                              echo $_SESSION['user-not-found']; //display session message
                              unset($_SESSION['user-not-found']); // removing session message
                    }
                    if (isset($_SESSION['pwd-not-match'])) {
                              echo $_SESSION['pwd-not-match']; //display session message
                              unset($_SESSION['pwd-not-match']); // removing session message
                    }
                    if (isset($_SESSION['change-pwd'])) {
                              echo $_SESSION['change-pwd']; //display session message
                              unset($_SESSION['change-pwd']); // removing session message
                    }
                    ?>
                    <a href="add-admin.php" class="btn-primary">Admin</a>

                    <table class="tbl-full">
                              <tr>
                                        <th>S.N</th>
                                        <th>Full Name</th>
                                        <th>Username</th>
                                        <th>Actions</th>
                              </tr>

                              <?php
                              $sql = "SELECT * from `tbl_admin`";
                              $res = mysqli_query($conn, $sql);

                              //check whether the query is executed or not
                              if ($res == TRUE) {
                                        // count rows to check whether we have data in db or not
                                        $count = mysqli_num_rows($res);

                                        $sn = 1; //create a variable and assign the value
                                        if ($count > 0) {
                                                  while ($count = mysqli_fetch_assoc($res)) {
                                                            $id = $count['id'];
                                                            $full_name = $count['full_name'];
                                                            $username = $count['username'];
                              ?>

                                                            <tr>
                                                                      <td> <?php echo $sn++ ?></td>
                                                                      <td><?php echo $full_name ?></td>
                                                                      <td><?php echo $username ?></td>
                                                                      <td>
                                                                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change password</a>
                                                                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-update">Update admin</a>
                                                                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-delete">Delete admin</a>
                                                                      </td>
                                                            </tr>

                              <?php
                                                  }
                                        } else {
                                        }
                              }
                              ?>





                    </table>

                    <div class="clearfix"></div>
          </div>
</div>
<!--
                    Main content section end
          -->
<!--

<?php
include('partials/footer.php');
?>