<?php
include('partials-FE/menu.php');
?>

<!--Food-search section starts here-->
<section class="food-search text-center">
          <div class="container">
                    <?php
                    $search = mysqli_real_escape_string($conn, $_POST['search']);
                    ?>
                    <h2>Foods on Your search <a href="a" class="text-white">"<?php echo $search; ?>"</a></h2>


          </div>
</section>
<!--End Food-search section-->
<!--food-menu section starts here-->
<section class="food-menu">
          <div class="container">
                    <h2 class="text-center">Food menu</h2>
                    <?php

                    $search = $_POST['search'];
                    //sql qeury to get foods 
                    $sql = "SELECT * FROM tbl_food WHERE title like '%$search%' OR description LIKE '%$search%'";

                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if ($count > 0) {
                              while ($row = mysqli_fetch_assoc($res)) {
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        $price = $row['price'];
                                        $description = $row['description'];
                                        $image_name = $row['image_name'];

                    ?>
                                        <div class="food-menu-box">
                                                  <div class="food-menu-img">
                                                            <?php
                                                            if ($image_name == "") {
                                                                      echo "<div class = 'error'>Image is not available</div>";
                                                            } else {
                                                            ?>
                                                                      <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Pizza" class="categories-img img-curved">
                                                            <?php
                                                            }
                                                            ?>

                                                  </div>
                                                  <div class="food-menu-desc">

                                                            <h4><?php echo $title; ?></h4>
                                                            <p class="food-price"><?php echo $price; ?></p>
                                                            <p class="food-detail"><?php echo $description; ?></p>
                                                            <a href="a" class="btn btn-primary">Order new</a>
                                                  </div>
                                        </div>

                    <?php

                              }
                    } else {
                              echo "<div class='error'>Food is not found.</div>";
                    }
                    ?>

                    <div class="clearfix"></div>
          </div>

</section>
<!--End food-menu section-->

<?php include('partials-FE/footer.php'); ?>