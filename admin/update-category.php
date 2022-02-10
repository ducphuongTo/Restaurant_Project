<?php
include('partials/menu.php');
ob_start();
?>

<div class="main-content">
          <div class="wrapper">
                    <h1>Update category</h1>
                    <br><br>

                    <?php
                    //check whether the id is exist or not

                    if (isset($_GET['id'])) {
                              //echo 'getting data';
                              $id = $_GET['id'];

                              $sql = "SELECT * FROM tbl_category WHERE id=$id";

                              $res = mysqli_query($conn, $sql);

                              $count = mysqli_num_rows($res);

                              if ($count == 1) {
                                        //get all the data
                                        $row = mysqli_fetch_assoc($res);
                                        $title = $row['title'];
                                        $current_image = $row['image_name'];
                                        $featured = $row['featured'];
                                        $active = $row['active'];
                              } else {
                                        $_SESSION['no-category-found'] = "<div class = 'error'>Category not found.</div>";
                                        header('location:' . SITEURL . 'admin/manage-category.php');
                              }
                    } else {
                              header('location:' . SITEURL . 'admin/manage-category.php');
                    }
                    ?>

                    <form action="" method="POST" enctype="multipart/form-data">
                              <table class="tbl-30">
                                        <tr>
                                                  <td>Title</td>
                                                  <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                                        </tr>
                                        <tr>
                                                  <td>Current Image:</td>
                                                  <td><?php
                                                            if ($current_image != "") {
                                                            ?>
                                                                      <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                                            <?php
                                                            } else {
                                                                      echo "<div class ='error'>Image is not added</div>";
                                                            }
                                                            ?>
                                                  </td>
                                        </tr>
                                        <tr>
                                                  <td>New image</td>
                                                  <td><input type="file" name="image"></td>
                                        </tr>

                                        <tr>
                                                  <td>Featured:</td>
                                                  <td>
                                                            <input <?php if ($featured == "Yes") {
                                                                                echo "checked";
                                                                      } ?> type="radio" name="featured" value="Yes">Yes
                                                            <input <?php if ($featured == "No") {
                                                                                echo "checked";
                                                                      } ?> type="radio" name="featured" value="No">No
                                                  </td>


                                        </tr>
                                        <tr>
                                                  <td>Active:</td>
                                                  <td>
                                                            <input <?php if ($active == "Yes") {
                                                                                echo "checked";
                                                                      } ?> type="radio" name="active" value="Yes">Yes
                                                            <input <?php if ($active == "No") {
                                                                                echo "checked";
                                                                      } ?> type="radio" name="active" value="No">No
                                                  </td>
                                        </tr>
                                        <tr>
                                                  <td>
                                                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                            <input type="submit" name="submit" value="Update category" class="btn-primary">
                                                  </td>
                                        </tr>
                              </table>
                    </form>
          </div>
</div>


<?php

if (isset($_POST['submit'])) {
          //echo "Clicked";
          //1. get all the values from our form

          $id = $_POST['id'];
          $title = $_POST['title'];
          $current_image = $_POST['current_image'];
          $featured = $_POST['featured'];
          $active = $_POST['active'];

          //2. updating new image if selected
          // check whether the image is selected or not
          if (isset($_FILES['image']['name'])) {
                    //get image details
                    $image_name = $_FILES['image']['name'];
                    if ($image_name != "") {
                              $image_name = $_FILES['image']['name'];
                              //auto rename
                              //get the extension of our image(ipg,png,gif)
                              $ext = end(explode('.', $image_name));
                              $image_name = "food_category_" . rand(000, 900) . '.' . $ext;
                              //updload image only if image is selected


                              $source_path = $_FILES['image']['tmp_name'];
                              $destination_path = "../images/category/" . $image_name;

                              $upload = move_uploaded_file($source_path, $destination_path);
                              if ($upload == false) {
                                        $_SESSION['upload'] = "<div class = 'error'>Fail to upload</div>";
                                        header('location:' . SITEURL . 'admin/manage-category.php');
                                        die();
                              }

                              //remove the current image if available
                              if ($current_image != "") {
                                        $remove_path = "../images/category/" . $current_image;
                                        $remove = unlink($remove_path);
                                        //check whether the image is removed
                                        if ($remove == false) {
                                                  $_SESSION['failed-remove'] = "<div class='error'>Fail to remove  current image</div>";
                                                  header('location:' . SITEURL . 'admin/mange-category.php');
                                                  die();
                                        }
                              }
                    } else {
                              $image_name = $current_image;
                    }
          } else {
                    $image_name = $current_image;
          }
          //3.  update the db
          $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
          ";
          $res2 = mysqli_query($conn, $sql2);

          if ($res == true) {

                    $_SESSION['update'] = "<div class='success'>Category updated successfully.</div>";
                    header('location:' . SITEURL . 'admin/manage-category.php');
                    ob_end_flush();
          } else {
                    $_SESSION['update'] = "<div class='error'>Fail to update category.</div>";
                    header('location:' . SITEURL . 'admin/manage-category.php');
          }
}
?>
<?php
include('partials/footer.php');
?>