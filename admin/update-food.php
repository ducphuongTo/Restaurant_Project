<?php
include('partials/menu.php');
ob_start();
?>
<?php
if (isset($_GET['id'])) {
          $id = $_GET['id'];

          $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

          $res2 = mysqli_query($conn, $sql2);

          $row2 = mysqli_fetch_assoc($res2);
          $title = $row2['title'];
          $description = $row2['description'];
          $price = $row2['price'];
          $current_image = $row2['image_name'];
          $current_category = $row2['category_id'];
          $featured = $row2['featured'];
          $active = $row2['active'];
} else {
          header('location:' . SITEURL . 'admin/manage-food.php');
}
?>

<div class="main-content">
          <div class="wrapper">
                    <h1>Update food</h1>
                    <br><br>


                    <form action="" method="POST" enctype="multipart/form-data">
                              <table class="tbl-30">
                                        <tr>
                                                  <td>Title</td>
                                                  <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                                        </tr>
                                        <tr>
                                                  <td>Description:</td>
                                                  <td>
                                                            <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                                                  </td>
                                        </tr>
                                        <tr>
                                                  <td>Price:</td>
                                                  <td>
                                                            <input type="number" name="price" value="<?php echo $price; ?>">
                                                  </td>
                                        </tr>

                                        <tr>
                                                  <td>Current Image:</td>
                                                  <td><?php
                                                            if ($current_image != "") {
                                                            ?>
                                                                      <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                                                            <?php
                                                            } else {
                                                                      echo "<div class ='error'>Image is not available</div>";
                                                            }
                                                            ?>
                                                  </td>
                                        </tr>
                                        <tr>
                                                  <td>New image</td>
                                                  <td><input type="file" name="image"></td>
                                        </tr>
                                        <tr>
                                                  <td>Category:</td>
                                                  <td>
                                                            <select name="category" id="">
                                                                      <?php
                                                                      $sql = "SELECT * FROM tbl_category where active = 'Yes'";
                                                                      $res = mysqli_query($conn, $sql);
                                                                      $count = mysqli_num_rows($res);
                                                                      if ($count > 0) {
                                                                                while ($row = mysqli_fetch_assoc($res)) {
                                                                                          $category_title = $row['title'];
                                                                                          $category_id = $row['id'];
                                                                                          //echo "<option value='$category_id'>$category_title</option>";
                                                                      ?>
                                                                                          <option <?php if ($current_category == $category_id) {
                                                                                                              echo "Selected";
                                                                                                    } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                                                      <?php

                                                                                }
                                                                      } else {
                                                                                echo "<option value = '0'>Category is note available</option>";
                                                                      }
                                                                      ?>
                                                                      <option value="0">Test category</option>
                                                            </select>
                                                  </td>
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
                                                            <input type="submit" name="submit" value="Update food" class="btn-primary">
                                                  </td>
                                        </tr>
                              </table>
                    </form>
                    <?php
                    if (isset($_POST['submit'])) {

                              //1. get all the details from the form
                              $id = $_POST['id'];
                              $title = $_POST['title'];
                              $description = $_POST['description'];
                              $price = $_POST['price'];
                              $category = $_POST['category'];


                              $featured = $_POST['featured'];
                              $active = $_POST['active'];
                              //2. upload the image if selected
                              if (isset($_FILES['image']['name'])) {
                                        //get image details
                                        $image_name = $_FILES['image']['name'];
                                        if ($image_name != "") {
                                                  $image_name = $_FILES['image']['name'];
                                                  //auto rename
                                                  //get the extension of our image(ipg,png,gif)
                                                  $part = explode('.', $image_name);
                                                  $ext = end($part);
                                                  $image_name = "food_name_" . rand(000, 900) . '.' . $ext;
                                                  //updload image only if image is selected


                                                  $source_path = $_FILES['image']['tmp_name'];
                                                  $destination_path = "../images/food/" . $image_name;

                                                  $upload = move_uploaded_file($source_path, $destination_path);
                                                  if ($upload == false) {
                                                            $_SESSION['upload'] = "<div class = 'error'>Fail to update new image food</div>";
                                                            header('location:' . SITEURL . 'admin/manage-food.php');
                                                            die();
                                                  }

                                                  //remove the current image if available
                                                  if ($current_image != "") {
                                                            $remove_path = "../images/food/" . $current_image;
                                                            $remove = unlink($remove_path);
                                                            //check whether the image is removed
                                                            if ($remove == false) {
                                                                      $_SESSION['remove-failed'] = "<div class='error'>Fail to remove  current image</div>";
                                                                      header('location:' . SITEURL . 'admin/mange-food.php');
                                                                      die();
                                                            }
                                                  }
                                        } else {
                                                  $image_name = $current_image;
                                        }
                              } else {
                                        $image_name = $current_image;
                              }

                              //3. remove the image if the new image is uploaded and current image exists

                              //4. update the food in db
                              $sql3 = "UPDATE tbl_food SET
                                        title = '$title',
                                        description = '$description',
                                        price = $price,
                                        image_name = '$image_name',
                                        category_id = '$category',
                                        featured = '$featured',
                                        active = '$active'
                                        WHERE ID = $id
                              ";
                              $res3 = mysqli_query($conn, $sql3);
                              if ($res3 == true) {
                                        $_SESSION['update'] = "<div class='success'>Food update successfully</div>";
                                        header('location:' . SITEURL . 'admin/manage-food.php');
                              } else {
                                        $_SESSION['update'] = "<div class='error'>Fail to update food</div>";
                                        header('location:' . SITEURL . 'admin/manage-food.php');
                              }                     //redirect
                    }
                    ?>
          </div>
</div>


<?php


?>
<?php
include('partials/footer.php');
?>