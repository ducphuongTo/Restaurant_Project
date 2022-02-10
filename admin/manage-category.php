<?php
include('partials/menu.php');
?>

<div class="main-contnet">
          <div class="wrapper">
                    <h1>Manage Category</h1>
                    <br /><br />
                    <?php
                    if (isset($_SESSION['add'])) {
                              echo $_SESSION['add'];
                              unset($_SESSION['add']);
                    }
                    if (isset($_SESSION['remove'])) {
                              echo $_SESSION['remove'];
                              unset($_SESSION['remove']);
                    }
                    if (isset($_SESSION['delete'])) {
                              echo $_SESSION['delete'];
                              unset($_SESSION['delete']);
                    }
                    if (isset($_SESSION['no-category-found'])) {
                              echo $_SESSION['no-category-found'];
                              unset($_SESSION['no-category-found']);
                    }
                    if (isset($_SESSION['update'])) {
                              echo $_SESSION['update'];
                              unset($_SESSION['update']);
                    }
                    if (isset($_SESSION['upload'])) {
                              echo $_SESSION['upload'];
                              unset($_SESSION['upload']);
                    }
                    if (isset($_SESSION['failed-remove'])) {
                              echo $_SESSION['failed-remove'];
                              unset($_SESSION['failed-remove']);
                    }
                    ?>
                    <br /><br />
                    <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add category</a>
                    <br /><br /><br />
                    <table class="tbl-full">
                              <tr>
                                        <td>S.N</td>
                                        <td>Title</td>
                                        <td>Image</td>
                                        <td>Feature</td>
                                        <td>Active</td>
                                        <td>Action</td>
                              </tr>
                              <?php
                              $sql = "SELECT * FROM tbl_category";

                              $res = mysqli_query($conn, $sql);

                              $count = mysqli_num_rows($res);
                              $sn = 1;

                              if ($count > 0) {
                                        //get the data and display
                                        while ($row = mysqli_fetch_assoc($res)) {
                                                  $id = $row['id'];
                                                  $title = $row['title'];
                                                  $image_name = $row['image_name'];
                                                  $featured = $row['featured'];
                                                  $active = $row['active'];

                              ?>
                                                  <tr>
                                                            <td><?php echo $sn++; ?></td>
                                                            <td><?php echo $title; ?></td>
                                                            <td>
                                                                      <?php

                                                                      //check whether image name is available 
                                                                      if ($image_name != "") {
                                                                      ?>
                                                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ?>" width="100px">
                                                                      <?php
                                                                      } else {
                                                                                echo "<div class = 'error'> Image is not added</div>";
                                                                      }

                                                                      ?>
                                                            </td>
                                                            <td><?php echo $featured ?></td>
                                                            <td><?php echo $active ?></td>
                                                            <td>
                                                                      <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-primary">Update category</a>
                                                                      <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php $image_name; ?>" class="btn-primary">Delete category</a>
                                                            </td>
                                                  </tr>
                                        <?php

                                        }
                              } else {
                                        ?>
                                        <tr>
                                                  <td colspan="6">
                                                            <div class="error">No category added</div>
                                                  </td>
                                        </tr>
                              <?php
                              }
                              ?>

                    </table>
          </div>

</div>

<?php
include('partials/footer.php');
?>