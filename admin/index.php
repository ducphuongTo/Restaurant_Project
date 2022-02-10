<?php
include('partials/menu.php');
?>

<!--
                    Main content section starts
          -->

<div class="main-content">
          <div class="wrapper">
                    <h1>Dashboard</h1>
                    <br><br>
                    <?php
                    if (isset($_SESSION['login'])) {
                              echo $_SESSION['login'];
                              unset($_SESSION['login']);
                    }
                    ?>
                    <br><br>
                    <div class="col-4 text-center">
                              <?php
                              $sql = "SELECT * from tbl_category";
                              $res = mysqli_query($conn, $sql);

                              $count = mysqli_num_rows($res);
                              ?>
                              <h1><?php echo $count; ?></h1>
                              <br>
                              Categories
                    </div>
                    <div class="col-4 text-center">
                              <?php
                              $sql_food = "SELECT * from tbl_category";
                              $res_food = mysqli_query($conn, $sql_food);

                              $count_food = mysqli_num_rows($res_food);
                              ?>
                              <h1><?php echo $count_food; ?></h1>
                              <br>
                              Foods
                    </div>
                    <div class="col-4 text-center">
                              <?php
                              $sql_total = "SELECT * from tbl_category ";
                              $res_total = mysqli_query($conn, $sql_total);

                              $count_total = mysqli_num_rows($res_total);
                              ?>

                              <h1><?php echo $count_total; ?></h1>
                              <br>
                              Total Orders
                    </div>
                    <div class="col-4 text-center">
                              <?php
                              $sql_revenue = "SELECT SUM(total) as Total from tbl_order WHERE status = 'Delivered'";
                              $res_revenue = mysqli_query($conn, $sql_revenue);

                              $row_revenue = mysqli_fetch_assoc($res_revenue);
                              $total_revenue = $row_revenue['Total'];
                              ?>
                              <h1> $ <?php echo $total_revenue; ?></h1>
                              <br>
                              Revenue Generated
                    </div>
                    <div class="clearfix"></div>
          </div>
</div>
<!--
                    Main content section end
          -->
<?php
include('partials/footer.php');
?>