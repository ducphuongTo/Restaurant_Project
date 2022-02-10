
<?php
include('../config/constants.php');
//1. get the id of admin
echo $id = $_GET['id'];

//2. create sql query to delete admin 
$sql = "DELETE from tbl_admin WHERE id = $id";
//execute the query
$res = mysqli_query($conn, $sql);
//check the query executed successfully
if ($res == true) {
          //create  session variable to display message
          $_SESSION['delete'] = "<div class='success'>Admin deleted successfully</div>";

          header('location:' . SITEURL . 'admin/manage-admin.php');
} else {
          echo "fail to delete";
          $_SESSION['delete'] = "<div class='error'>Fail to delete</div>";

          header('location:' . SITEURL . 'admin/manage-admin.php');
}
 //3. redirect to manage admin page
