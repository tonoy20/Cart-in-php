<?php
include("topbar.php");
?>
<?php
$cat_id = $_GET['cat_id'];
$sql = "SELECT * FROM categories WHERE id = $cat_id";
$qu_run = mysqli_query($data, $sql);
$row = mysqli_fetch_assoc($qu_run);
?>
<div id="all">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="box">
                        <h1><?php echo $row['title'] ?></h1>
                        <p><?php echo $row['description'] ?></p>
                    </div>
                </div>
            </div>
            <div class="row products">
                    <?php
                    $prod_array = [];
                    $fetch_src = FETCH_SRC;
                    $sql2 = "SELECT `product_id` FROM `product_categories` WHERE `category_id` = $cat_id";
                    $qu_run2 = mysqli_query($data, $sql2);
                    while ($row = mysqli_fetch_assoc($qu_run2)) {
                        array_push($prod_array, $row['product_id']);
                    }
                    if (count($prod_array) == 0) {
                        echo "No Products Available";
                    }
                    for ($x = 0; $x < count($prod_array); $x++) {
                        $p_id = $prod_array[$x];
                        $sql3 = "SELECT * FROM products WHERE id=$p_id";
                        $qu_run3 = mysqli_query($data, $sql3);
                        while ($row3 = mysqli_fetch_assoc($qu_run3)) {
                    ?>
                        <div class="col-lg-4 col-md-3">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class=""><a href="productDetail.php?re=<?php echo $row3['id']; ?>">
                                                <div class=""> <img src="<?= $fetch_src . $row3['image'] ?>" alt="" class="img-fluid"> </div>
                                            </a>
                                        </div>
                                        <div class="text">
                                            <h3><a href="productDetail.php?re=<?php echo $row3['id']; ?>"><?php echo $row3['name'] ?></a></h3>
                                            <p class="price">
                                                <del></del>$<?php echo $row3['price'] ?>
                                            </p>
                                            <p class="buttons"><a href="productDetail.php?re=<?php echo $row3['id']; ?>" class="btn btn-outline-secondary">View detail</a></p>
                                        </div>
                                    </div>
                                    <!-- /.product  -->
                                </div>
                                <!-- /.products-->
                            </div>
                        </div>
                    <?php
                        }
                    }
                    ?>
                
            </div>
        </div>
    </div>
</div>
<?php
include("footer.php");
?>