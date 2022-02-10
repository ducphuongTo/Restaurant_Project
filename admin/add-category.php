<?php
include('partials/menu.php');
?>

<div class="main-content">
          <div class="wrapper">
                    <h1>Add category</h1>
                    <br /><br />
                    <?php
                    if (isset($_SESSION['add'])) {
                              echo $_SESSION['add'];
                              unset($_SESSION['add']);
                    }
                    if (isset($_SESSION['upload'])) {
                              echo $_SESSION['upload'];
                              unset($_SESSION['upload']);
                    }
                    ?>
                    <br><br>
                    <form action="" method="POST" enctype="multipart/form-data">
                              <table class="tbl-30">
                                        <tr>
                                                  <td>Title:</td>
                                                  <td><input type="text" name="title" placeholder="Category title"></td>
                                        </tr>
                                        <tr>
                                                  <td>Add image</td>
                                                  <td>
                                                            <input type="file" name="image">
                                                  </td>
                                        </tr>
                                        <tr>
                                                  <td>Featured:</td>
                                                  <td>
                                                            <input type="radio" name="featured" value="yes">Yes
                                                            <input type="radio" name="featured" value="no">No
                                                  </td>
                                        </tr>
                                        <tr>
                                                  <td>Active:</td>
                                                  <td>
                                                            <input type="radio" name="active" value="yes">Yes
                                                            <input type="radio" name="active" value="no">No

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
                              if (isset($_FILES['image']['name'])) {
                                        if ($image_name != "") {
                                                  //to upload image, we need image name and path
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
                                                            header('location:' . SITEURL . 'admin/add-category.php');
                                                            die();
                                                  }
                                        }
                              } else {
                                        $image_name = "";
                              }
                              $sql = "INSERT INTO tbl_category SET
                                        title = '$title',
                                        image_name = '$image_name',
                                        featured = '$featured',
                                        active = '$active'
                              ";
                              $res = mysqli_query($conn, $sql);

                              if ($res == true) {
                                        $_SESSION['add'] = "<div class = 'success'>Category added successfully</div>";
                                        header("location:" . SITEURL . 'admin/manage-category.php');
                              } else {
                                        $_SESSION['add'] = "<div class = 'error'>Fail to add category</div>";
                                        header("location:" . SITEURL . 'admin/add-category.php');
                              }
                    }
                    ?>

          </div>
</div>
<?php
include('partials/footer.php');
?>