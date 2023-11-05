<?php include("topbar.php") ?>
<div id="all">
  <div id="content">
    <div class="container">
      <div class="row">
        <div class="col-md-10">
          <div id="main-slider" class="owl-carousel owl-theme ">
            <?php
            $fetch_src = FETCH_SRC;
            $sql1 = "SELECT * FROM products";
            $q_run1 = mysqli_query($data, $sql1);
            while ($row = mysqli_fetch_assoc($q_run1)) {
            ?>
              <div class="item"><img src=<?= $fetch_src . $row['image'] ?> alt="product_image" class="img-fluid" style="display:block; width: 30% height:auto;"></div>
            <?php
            }
            ?>
          </div>
          <!-- /#main-slider-->
        </div>
      </div>
    </div>

    <!--
        *** ADVANTAGES HOMEPAGE ***
        _________________________________________________________
        -->
    <div id="advantages">
      <div class="container">
        <div class="row mb-4">
          <div class="col-md-4">
            <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
              <div class="icon"><i class="fa fa-heart"></i></div>
              <h3><a href="#">We love our customers</a></h3>
              <p class="mb-0">We are known to provide best possible service ever</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
              <div class="icon"><i class="fa fa-tags"></i></div>
              <h3><a href="#">Best prices</a></h3>
              <p class="mb-0">You can check that the height of the boxes adjust when longer text like this one is used in one of them.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
              <div class="icon"><i class="fa fa-thumbs-up"></i></div>
              <h3><a href="#">100% satisfaction guaranteed</a></h3>
              <p class="mb-0">Free returns on everything for 1 months.</p>
            </div>
          </div>
        </div>
        <!-- /.row-->
      </div>
      <!-- /.container-->
    </div>
    <!-- /#advantages-->
    <!-- *** ADVANTAGES END ***-->
    <!--
        *** HOT PRODUCT SLIDESHOW ***
        _________________________________________________________
        -->
    <div class="container py-5" style="text-align: center;">
      <h1 class="display-2">Our Products</h1>
      <div class="row">
        <?php
        $qu1 = "SELECT * FROM products";
        $q_r1 = mysqli_query($data, $qu1);
        $check = mysqli_num_rows($q_r1);
        if ($check) {
          while ($row = mysqli_fetch_assoc($q_r1)) {
        ?>
            <div class="col md-3 mt-3">
              <div class="card" style="width: 18rem;">
                <a href="productDetail.php?re=<?php echo $row['id']; ?>"> <img src="<?= $fetch_src . $row['image'] ?>" width="200px" class="card-img-top" height="200px" alt=""> </a>
                <div class="card-body">
                  <h2 class="card-title text-secondary" style="text-align: center;"><?php echo $row['name'] ?></h2>
                  <p class="cad-text text-info" style="text-align: center;">Price -  <i class="fa fa-usd"></i> <?php echo $row['price'] ?></p>
                  <p class="buttons"><a href="productDetail.php?re=<?php echo $row['id']; ?>" class="btn btn-outline-secondary">View detail</a></p>
                </div>
              </div>
            </div>
        <?php
          }
        } else {
          echo "No Products Available";
        }
        ?>
      </div>
    </div>
    <div class="text-center"><a href="AllProducts.php"><h1>Watch More of Our Products</h1></a></div>
    <!--
        *** GET INSPIRED ***
        _________________________________________________________
        -->
    <div class="container">
      <div class="col-md-12">
        <div class="box slideshow">
          <h3>Get Inspired</h3>
          <p class="lead">Get the inspiration from our world class designers</p>
          <div id="get-inspired" class="owl-carousel owl-theme">
            <div class="item"><a href="#"><img src="https://pm1.aminoapps.com/6276/a71d04f8e7fe626104da9150730eb1c5119e9c7e_hq.jpg" alt="Get inspired" class="img-fluid"></a></div>
          </div>
        </div>
      </div>
    </div>
    <!-- *** GET INSPIRED END ***-->
    <div class="box text-center">
      <div class="container">
        <div class="col-md-12">
          <h3 class="text-uppercase">BEST SELLER</h3>
        </div>
      </div>
    </div>
    <!-- Best Seller product -->
    <div class="container">
      <div class="col-md-12">
        <div id="blog-homepage" class="row">
          <?php
          $sql2 = "SELECT product_id, count(quantity) 
          from order_products 
          group by product_id 
          order by count(quantity) 
          desc limit 3;";
          $s_run2 = mysqli_query($data, $sql2);
          while ($row2 = mysqli_fetch_assoc($s_run2)) {
            $sql3 = "SELECT * FROM products WHERE id = $row2[product_id] ";
            $s_run3 = mysqli_query($data, $sql3);
            while ($row3 = mysqli_fetch_assoc($s_run3)) {
          ?>
              <div class="col-4 md-3 mt-3">
              <div class="card" style="width: 18rem;">
                <a href="productDetail.php?re=<?php echo $row3['id']; ?>"> <img src="<?= $fetch_src . $row3['image'] ?>" width="200px" class="card-img-top" height="200px" alt=""> </a>
                <div class="card-body">
                  <h2 class="card-title text-secondary" style="text-align: center;"><?php echo $row3['name'] ?></h2>
                  <p class="cad-text text-info" style="text-align: center;">price - <i class="fa fa-usd"></i><?php echo $row3['price'] ?></p>
                  <p class="buttons" style="text-align: center;"><a href="productDetail.php?re=<?php echo $row3['id']; ?>" class="btn btn-outline-secondary" >View detail</a></p>
                </div>
                <div class="ribbon new">
                    <div class="theribbon"><p class="small">BEST SALE</p></div>
                    <div class="ribbon-background"></div>
                </div>
              </div>
            </div>
          <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
    <!-- BEST SELLER -->

    <!-- /.container-->
    <!-- *** BLOG HOMEPAGE END ***-->
  </div>
</div>

<?php include("footer.php") ?>