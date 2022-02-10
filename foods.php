<?php
include('partials-FE/menu.php');
?>
<!--Food-search section starts here-->
<section class="food-search text-center">
          <div class="container">
                    <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                              <input type="search" name="search" placeholder="Search for food">
                              <input type="submit" name="submit" value="search" class="btn btn-primary">
                    </form>

          </div>
</section>
<!--End Food-search section-->



<!--food-menu section starts here-->
<section class="food-menu">
          <div class="container">
                    <h2 class="text-center">Food menu</h2>
                    <?php
                    $sql = "SELECT * FROM tbl_food where active = 'Yes'";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    if ($count > 0) {
                              while ($row = mysqli_fetch_assoc($res)) {
                                        //get the values
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        $description = $row['description'];
                                        $price = $row['price'];
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
                                                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order new</a>
                                                  </div>
                                        </div>
                    <?php
                              }
                    } else {
                              echo "<div class='error'>Food is not added.</div>";
                    }
                    ?>



                    <div class="clearfix"></div>
          </div>

</section>
<!--End food-menu section-->

<?php include('partials-FE/footer.php'); ?>