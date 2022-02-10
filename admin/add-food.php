<?php
include('partials/menu.php');
ob_start();
?>

<div class="main-content">
          <div class="wrapper">
                    <h1>Add food</h1>
                    <br /><br />
                    <?php
                    if (isset($_SESSION['upload'])) {
                              echo $_SESSION['upload'];
                              unset($_SESSION['upload']);
                    }
                    ?>
                    <br /><br />
                    <form action="" method="POST" enctype="multipart/form-data">
                              <table class="tbl-30">
                                        <tr>
                                                  <td>Title:</td>
                                                  <td><input type="text" name="title" placeholder="Title of the food"></td>
                                        </tr>
                                        <tr>
                                                  <td>Description</td>
                                                  <td>
                                                            <textarea name="description" id="" cols="30" rows="5" placeholder="Describe of the food"></textarea>
                                                  </td>
                                        </tr>
                                        <tr>
                                                  <td>Price</td>
                                                  <td>
                                                            <input type="number" name="price">
                                                  </td>
                                        </tr>
                                        <tr>
                                                  <td>Select image:</td>
                                                  <td>

                                                            <input type="file" name="image">

                                                  </td>
                                        </tr>
                                        <tr>
                                                  <td>Category:</td>
                                                  <td>
                                                            <select name="category" id="">
                                                                      <?php
                                                                      //create php code to display  categories from data
                                                                      //1. create sql to get all active categories from the db
                                                                      //display on dropdown
                                                                      $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                                                                      $res = mysqli_query($conn, $sql);

                                                                      $count = mysqli_num_rows($res);
                                                                      if ($count > 0) {
                                                                                while ($row = mysqli_fetch_assoc($res)) {
                                                                                          $id = $row['id'];
                                                                                          $title = $row['title'];
                                                                      ?>
                                                                                          <option value="<?php echo $id; ?>">
                                                                                                    <?php echo $title; ?> </option>
                                                                                <?php

                                                                                }
                                                                      } else {
                                                                                ?>
                                                                                <option value="0">No category found</option>
                                                                      <?php
                                                                      }
                                                                      ?>

                                                            </select>
                                                  </td>
                                        </tr>
                                        <tr>
                                                  <td>Featured:</td>
                                                  <td>
                                                            <input type="radio" name="featured" value="Yes">Yes
                                                            <input type="radio" name="featured" value="No">No
                                                  </td>



                                        </tr>
                                        <tr>
                                                  <td>Active:</td>
                                                  <td>
                                                            <input type="radio" name="active" value="Yes">Yes
                                                            <input type="radio" name="active" value="No">No
                                                  </td>



                                        </tr>
                                        <tr>
                                                  <td colspan="2">
                                                            <input type="submit" name="submit" value="Add category" class="btn-primary">
                                                  </td>
                                        </tr>
                              </table>
                    </form>
                    <?php
                    if (isset($_POST['submit'])) {
                              //echo "CLiked";
                              //1. get the value from category
                              $title = $_POST['title'];
                              $description = $_POST['description'];
                              $price = $_POST['price'];
                              $category = $_POST['category'];

                              if (isset($_POST['featured'])) {
                                        //get the value from form
                                        $featured = $_POST['featured'];
                              } else {
                                        $featured = "No";
                              }
                              if (isset($_POST['active'])) {
                                        $active = $_POST['active'];
                              } else {
                                        $active = "No";
                              }
                              //check whether image is selected or not

                              //upload the image if selected 
                              // check whether the select image is clicked or not and upload the image only if the image is selected

                              if (isset($_FILES['image']['name'])) {
                                        $image_name = $_FILES['image']['name'];
                                        if ($image_name != "") {
                                                  //to upload image, we need image name and path

                                                  //auto rename
                                                  //get the extension of our image(ipg,png,gif)
                                                  $ext = end(explode('.', $image_name));
                                                  $image_name = "food_image_" . rand(000, 900) . '.' . $ext;
                                                  //updload image only if image is selected


                                                  $source_path = $_FILES['image']['tmp_name'];
                                                  $destination_path = "../images/food/" . $image_name;

                                                  $upload = move_uploaded_file($source_path, $destination_path);
                                                  if ($upload == false) {
                                                            $_SESSION['upload'] = "<div class = 'error'>Fail to upload</div>";
                                                            header('location:' . SITEURL . 'admin/add-food.php');
                                                            die();
                                                  }
                                        }
                              } else {
                                        $image_name = "";
                              }
                              //3. insert into db
                              $sql2 = "INSERT INTO tbl_food SET
                                        title = '$title',
                                        description = '$description',
                                        price = $price,
                                        image_name = '$image_name',
                                        category_id = $category,
                                        featured = '$featured',
                                        active = '$active'
                              ";

                              $res2 = mysqli_query($conn, $sql2);

                              if ($res2 == true) {
                                        $_SESSION['add'] = "<div class='success'>Food added successfully.</div>";
                                        header('location:' . SITEURL . 'admin/manage-food.php');
                              } else {
                                        $_SESSION['add'] = "<div class='error'>Failed to add food.</div>";
                                        header('location:' . SITEURL . 'admin/manage-food.php');
                              }
                              //4. redirect with message to manage food
                    }
                    ?>

          </div>
</div>
<?php
include('partials/footer.php');
?>