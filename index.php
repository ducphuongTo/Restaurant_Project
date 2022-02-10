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
<?php
if (isset($_SESSION['order'])) {
      echo $_SESSION['order'];
      unset($_SESSION['order']);
}
?>

<!--Categories section starts here-->
<section class="categories">
      <div class="container">
            <h2 class="text-center">Categories</h2>
            <?php
            //create sq; query to display categories from db
            $sql = "SELECT * FROM tbl_category where active = 'Yes' AND featured = 'Yes' LIMIT 3";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                  while ($row = mysqli_fetch_assoc($res)) {
                        //get the values
                        $id = $row['id'];

                        $title = $row['title'];
                        $image_name = $row['image_name'];
            ?>
                        <a href="<?php echo SITEURL; ?>category-food.php?category_id=<?php echo $id; ?>">
                              <div class="box-3 float-container">
                                    <?php
                                    if ($image_name == "") {
                                          echo "<div class = 'error'>Image is not available</div>";
                                    } else {
                                    ?>
                                          <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="categories-img img-curved">
                                    <?php
                                    }
                                    ?>


                                    <h1 class="float-text text-white"><?php echo $title; ?></h1>
                              </div>
                        </a>
            <?php
                  }
            } else {
                  echo "<div class='error'>Category is not added.</div>";
            }

            ?>


            <div class="clearfix"></div>
      </div>

</section>
<!--End Categories section-->


<!--food-menu section starts here-->
<section class="food-menu">
      <div class="container">
            <h2 class="text-center">Explore food</h2>
            <?php
            $sql2 = "SELECT * from tbl_food WHERE active = 'Yes' AND featured = 'Yes' LIMIT 6";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if ($count2 > 0) {
                  while ($row = mysqli_fetch_assoc($res2)) {
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
                                    <p class="food-price">$<?php echo $price; ?></p>
                                    <p class="food-detail"><?php echo $description; ?></p>
                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order new</a>
                              </div>
                        </div>
            <?php
                  }
            } else {
                  echo "<div class='error'>Food is not available</div>";
            }
            ?>



            <div class="clearfix"></div>
      </div>

</section>
<!--End food-menu section-->

<?php include('partials-FE/footer.php'); ?>