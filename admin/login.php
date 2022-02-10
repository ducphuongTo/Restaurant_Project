<?php
include('partials/menu.php');
?>

<html>

<head>

          <title> Login - Food order system</title>
          <link rel="stylesheet" href="../css/admin.php">
          </link>
</head>

<body>
          <div class="login">
                    <h1 class="text-center">Login</h1>
                    <br><br>
                    <?php
                    if (isset($_SESSION['login'])) {
                              echo $_SESSION['login'];
                              unset($_SESSION['login']);
                    }
                    if (isset($_SESSION['no-login-message'])) {
                              echo $_SESSION['no-login-message'];
                              unset($_SESSION['no-login-message']);
                    }
                    ?>
                    <br><br>
                    <form action="" method="POST" class="text-center">
                              Username: <br>
                              <input type="text" name="username" placeholder="Enter username"> <br> <br>
                              Password: <br>
                              <input type="password" name="password" placeholder="Enter password"> <br> <br>

                              <input type="submit" name="submit" value="Login" class="btn-primary">

                    </form>
          </div>

</body>

</html>

<?php
//check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
          //process
          //1. get the data from login form
          $username = mysqli_real_escape_string($conn, $_POST['username']);
          $password = mysqli_real_escape_string($conn, md5($_POST['password']));

          //2. sql to check whether the user with username and pwd exist or not

          $sql = "SELECT * from tbl_admin WHERE username = '$username' and password = '$password'";

          $res = mysqli_query($conn, $sql);

          $count = mysqli_num_rows($res);
          if ($count == 1) {
                    $_SESSION['login'] = "<div class = 'success text-center'>Login successfully</div>";
                    $_SESSION['user'] = $username;

                    header("location:" . SITEURL . 'admin/index.php');
          } else {
                    $_SESSION['login'] = "<div class = 'error text-center'>Username or password did not match.</div>";
                    header("location:" . SITEURL . 'admin/login.php');
          }
}
?>


<?php
include('partials/footer.php');
?>