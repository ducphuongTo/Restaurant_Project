<?php
include('partials/menu.php');
?>

<?php
if (isset($_GET['id']) and isset($_GET['image_name'])) {
          //echo "get value and delete";
          //1. get id and image name
          $id = $_GET['id'];
          $image_name = $_GET['image_name'];

          if ($image_name != "") {
                    $path = "../images/food/" . $image_name;
                    //remove the image
                    $remove = unlink($path);
                    //if faile to remove image then display error
                    if ($remove == false) {
                              $_SESSION['upload'] = "<div class ='error'>Fail to remove food image. </div>";
                              header('location:' . SITEURL . 'admin/manage-food.php');
                              die();
                    }
          }
          //3. delete data from db
          $sql = "DELETE FROM tbl_food WHERE id=$id";
          $res = mysqli_query($conn, $sql);

          if ($res == true) {
                    $_SESSION['delete'] = "<div class = 'success'>Deleted food Successfully</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
          } else {
                    $_SESSION['delete'] = "<div class = 'error'>Fail to delete food</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
          }
} else {
          $_SESSION['unauthorize'] = "<div class ='error'>Unauthorized Access.</div>";
          header('location:' . SITEURL . 'admin/manage-food.php');
}
?>

<?php
include('partials/footer.php');
?>