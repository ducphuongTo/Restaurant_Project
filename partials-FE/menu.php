<?php
include('config/constants.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="css/style.css">

          <title>Restaurant Project</title>
</head>

<body>
          <!--Navbar section starts here-->
          <section class="navbar">
                    <div class="container">
                              <div class="logo">
                                        <img src="images/logo.png" alt="restaurant logo" class="img-logo">
                              </div>
                              <div class="menu text-right">
                                        <ul>
                                                  <li>
                                                            <a href="<?php echo SITEURL; ?>">Home</a>
                                                  </li>
                                                  <li>
                                                            <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                                                  </li>
                                                  <li>
                                                            <a href="<?php echo SITEURL ?>foods.php">Foods</a>
                                                  </li>
                                                  <li>
                                                            <a href="a">Contact</a>
                                                  </li>
                                        </ul>
                              </div>
                              <div class="clearfix">

                              </div>
                    </div>
          </section>
          <!--End Navbar section-->