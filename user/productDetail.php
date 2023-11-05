<?php
include("topbar.php");
?>
<?php
$multiple_fetch = FETCH_MULTIPLE;
$fetch_src = FETCH_SRC;
$product_id = $_GET['re'];
$sql = "SELECT * FROM products WHERE id = $product_id";
$sq_run =  mysqli_query($data, $sql);
$row = mysqli_fetch_assoc($sq_run);
$main_img = $fetch_src . $row['image'];
?>

<div class="col-lg-9 order-1 order-lg-2">
    <div id="productMain" class="row">
        <div class="col-md-6">
            <div data-slider-id="1" class="owl-carousel shop-detail-carousel" id="big_image">
                <div class="item"> <img style="margin-left : 20px; height:350px; width: 350px;" src=<?= $fetch_src . $row['image'] ?> alt="" class="img-fluid"></div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box">
                <form action="crudCart.php" method="POST">
                    <h1 class="text-center"><?= $row['name'] ?></h1>
                    <p class="goToDescription" style="text-align: center;"><a href="#details" class="scroll-to">Scroll to product details, material &amp; care and sizing</a></p>
                    <p class="price" style="text-align: center; font-size:2rem"><i class="fa fa-usd"></i> <?= $row['price'] ?></p>
                    <label> Quantity</label>
                    <input class="form-control" class="p-2" type="number" value="" name="pquantity">
                    <input type="hidden" value="<?= $row['id'] ?>" name="pid">
                    <input type="hidden" value="<?= $row['name'] ?>" name="pname">
                    <input type="hidden" value="<?= $row['price'] ?>" name="pprice">
                    <p class="pt-2 text-center buttons"><button type="submit" name="addCart" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</button></p>
                </form>
            </div>
        </div>
        <div data-slider-id="1" class="owl-thumbs p-3">
            <?php
            $sql1 = "SELECT * FROM product_galary WHERE product_id = '$product_id' ";
            $sq1_run = mysqli_query($data, $sql1);
            echo "<img type='button' style='margin-left : 10px; margin-top : 10px; height:150px; width:150px' class='img-fluid p-3' src='" . $main_img . "' onClick=showMultiple('" . $main_img . "')>";
            while ($res1 = mysqli_fetch_assoc($sq1_run)) {
                $imgm = $multiple_fetch . $res1['images'];
                echo "<img type='button' style='margin-left : 10px; margin-top : 10px; height:150px; width:150px' class='img-fluid p-3' src='" . $imgm . "' onClick=showMultiple('" . $imgm . "')>";
            }
            ?>
        </div>
    </div>
    <div id="details" class="box">
        <h4>Product details</h4>
        <p></p>
        <h4>Brand</h4>
        <ul>
            <li><?= $row['brand'] ?></li>
        </ul>
        <h4>Size &amp; Fit</h4>
        <ul>
            <li>Regular fit</li>
            <li><?= $row['size'] ?></li>
        </ul>
        <h4>Color Available</h4>
        <ul>
            <li><?= $row['color'] ?></li>
        </ul>
        <blockquote>
            <p><em>We give our customers the best of market with quality & design. Also we give 1 month trial for our products.</em></p>
        </blockquote>
        <hr>
        <div class="social">
            <h4>Show it to your friends</h4>
            <p><a href="#" class="external facebook"><i class="fa fa-facebook"></i></a><a href="#" class="external gplus"><i class="fa fa-google-plus"></i></a><a href="#" class="external twitter"><i class="fa fa-twitter"></i></a><a href="#" class="email"><i class="fa fa-envelope"></i></a></p>
        </div>
    </div>
</div>

<!-- comment & raitng section -->

<section style="background-color: #eee;">
    <div class="container my-5 py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <?php
                        $sql2 = "SELECT * FROM product_reviews WHERE product_id = $product_id";
                        $res2 = mysqli_query($data, $sql2);
                        while ($row2 = mysqli_fetch_assoc($res2)) {
                        ?>
                            <div class="d-flex flex-start align-items-center">
                                <?php
                                $sql3 = "SELECT username FROM users WHERE id = $row2[user_id] ";
                                $res3 = mysqli_query($data, $sql3);
                                while ($row3 = mysqli_fetch_assoc($res3)) {
                                ?>
                                    <h6 class="fw-bold text-primary mb-1"><?php echo $row3['username'] ?></h6>
                                <?php
                                }
                                ?>
                            </div>
                            <p class="text-muted small mb-0">
                                <?php echo $row2['added_on'] ?>
                            </p>
                            <p class="mt-3 mb-4">
                                <?php echo $row2['review'] ?>
                            </p>
                            <p class="mt-3 mb-4 pb-2">
                                Rating : <?php echo $row2['rating'] ?> / 5
                            </p>
                        <?php
                        }
                        ?>
                    </div>

                    <?php
                    if (isset($_SESSION['uname'])) {
                        $user_id = $_SESSION['user_id'];
                    ?>
                        <form action="updateComments.php?pro=<?= $product_id ?>&uid=<?= $user_id ?>" method="POST">
                            <h1 class="text-center">Drop Your Comment </h1>
                            <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                                <div class="d-flex flex-start w-100">
                                    <div class="form-outline w-100">
                                        <textarea class="form-control" name="review" rows="4" style="background: #fff;"></textarea>
                                        <label class="form-label" for="textAreaExample">Message</label>
                                    </div>
                                </div>
                                <label for="Ratings"><span style='font-size: 12pt;' class='badge badge-light'>Ratings</span></label>
                                <select class="form-select" name="rating" style="padding: 10px; background:#edf2ff; border:none;">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <div class="float-end mt-2 pt-1">
                                    <button type="submit" name="review_submit" class="btn btn-primary btn-sm">Post comment</button>
                                    <button type="button" class="btn btn-outline-primary btn-sm">Cancel</button>
                                </div>
                            </div>
                        </form>
                    <?php
                    } else {
                        echo "<span style='font-size: 16pt;' class='badge badge-light'>Please <a href='../login.php'>Login</a> to drop your comment!</span>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    function showMultiple(im) {
        jQuery('#big_image').html("<img style='margin-left : 20px;height:350px; width: 350px;' src='" + im + "' />");
    }
</script>

<?php
include("footer.php");
?>