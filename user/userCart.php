<?php
include("topbar.php");
?>

<div id="all">
  <div id="content">
    <div class="container">
      <div class="row">
        <div id="basket" class="col-lg-9">
          <div class="box">
            <h1>Shopping cart</h1>
            <p class="text-muted"></p>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th colspan="2">Product</th>
                    <th>Quantity</th>
                    <th>Unit price</th>
                    <th>Discount</th>
                    <th colspan="2">Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $total = 0;
                  $fetch_src = FETCH_SRC;
                  if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $key => $value1) {
                      //get image;
                      $img_id = $value1['productID'];
                      $sql = "SELECT image FROM products WHERE id = '$img_id' ";
                      $row = mysqli_query($data, $sql);
                      $res = mysqli_fetch_assoc($row);
                      $total = $total + $value1['productQuantity'] * $value1['productPrice'];
                  ?>
                      <form action="deleteCart.php" method="POST">
                        <tr>
                          <td><a href="#"><img src="<?= $fetch_src . $res['image'] ?>" alt=""></a></td>
                          <td><a href="#"><?= $value1['productName'] ?></a>
                            <input type="hidden" name="upname" value=<?php echo $value1['productName'] ?>>
                          </td>
                          <td>
                            <input type="number" name="upQuantity" min='1' max='10' value="<?= $value1['productQuantity'] ?>" class="form-control">
                          </td>
                          <td>$<?= $value1['productPrice'] ?>
                            <input type="hidden" name="uprice" value=<?php echo $value1['productPrice']  ?>>
                          </td>
                          <td>$0.00</td>
                          <td>$<?= $value1['productQuantity'] * $value1['productPrice'] ?></td>

                          <td>
                            <button class="btn btn-outline-secondary" name="update"><i class="fa fa-refresh"></i>Update cart</button>
                            <button class="btn btn-danger" name="remove"><i class="fa fa-trash-o"></i></button>
                          </td>
                          <td><input type="hidden" name="item" value=<?php echo $value1['productID']  ?>></td>
                        </tr>
                      </form>
                  <?php
                    }
                  }
                  ?>
                </tbody>

                <tfoot>
                  <tr>
                    <th colspan="5">Total</th>
                    <th colspan="2"><?php echo $total;
                                    $_SESSION['total_amount'] = $total; ?> 
                                  </th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.table-responsive-->
            <div class="box-footer d-flex justify-content-between flex-column flex-lg-row">
              <div class="left"><a href="userhome.php" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> Continue shopping</a></div>
              <div class="right">
                <?php if($_SESSION['total_amount'] == 0) {
                ?>
                <a href="userhome.php"><button type="submit" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i></button></a>
                <?php 
                } else {
                  ?>
                    <a href="../login.php"><button type="submit" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i></button></a>
                  <?php
                }
                ?>
              </div>
            </div>
          </div>
          <!-- /.box-->
        </div>
      </div>
    </div>
  </div>
</div>


<?php
include("footer.php");
?>