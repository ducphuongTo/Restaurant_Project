<?php
include('partials-FE/menu.php');
?>

<!--Categories section starts here-->
<section class="categories">
          <div class="container">
                    <h2 class="text-center">Categories</h2>
                    <?php
                    $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
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


<?php include('partials-FE/footer.php'); ?>