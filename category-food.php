<?php
include('partials-FE/menu.php');
?>
<?php
if (isset($_GET['category_id'])) {
          //category id is set 
          $category_id = $_GET['category_id'];
          $sql = "SELECT title from tbl_category where id = $category_id";
          $res = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($res);
          $category_title = $row['title'];
} else {
          header('location:' . SITEURL);
}
?>

<!--Food-search section starts here-->
<section class="food-search text-center">
          <div class="container">
                    <h2 class="text-center">Foods on <a href="" class="text-white"><?php echo $category_title; ?></a></h2>
          </div>
</section>
<!--End Food-search section-->
<!--food-menu section starts here-->
<section class="food-menu">
          <div class="container">
                    <?php
                    $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);

                    if ($count2 > 0) {
                              while ($row2 = mysqli_fetch_assoc($res2)) {
                                        //get the values
                                        $id = $row2['id'];
                                        $title = $row2['title'];
                                        $image_name = $row2['image_name'];
                                        $description = $row2['description'];
                                        $price = $row2['price'];
                    ?>
                                        <div class="food-menu-box">
                                                  <div class="food-menu-img">
                                                            <?php
                                                            if ($image_name == "") {
                                                                      echo "<div class = 'error'>Image is not available</div>";
                                                            } else {
                                                            ?>
                                                                      <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicken hawai" class="img-curved img-logo">
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
                              echo "<div class='error'>Food is not available.</div>";
                    }
                    ?>




                    <div class="clearfix"></div>
          </div>

</section>
<!--End food-menu section-->

<?php include('partials-FE/footer.php'); ?>