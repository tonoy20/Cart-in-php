<?php 
    include("topbar.php");
?>
<?php
    $address='';
    $user_id = $_SESSION['user_id'];
    $res = mysqli_query($data, "SELECT address FROM orders WHERE user_id = '$user_id' order by id desc");
    $row = mysqli_fetch_assoc($res);
    if($row>0) {
        $address = $row['address'];
    }
?>
<div id="all">
    <div id="content">
        <div class="container">
            <div class="row">
            <div id="checkout" class="col-lg-9">
              <div class="box">
                <form method="POST" action="addOrder.php">
                  <h1>Checkout - Address</h1>
                  <div class="nav flex-column flex-md-row nav-pills text-center"><a href="#" class="nav-link flex-sm-fill text-sm-center active"> <i class="fa fa-map-marker"></i>Address</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-truck"></i>Delivery Method</a></div>
                  <div class="content py-3">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="address">Address</label>
                          <input class="form-control" name="address" type="text" required value=<?php echo $address ?> >
                        </div>
                      </div>
                    </div>
                    <!-- /.row-->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="phone">Telephone</label>
                          <input name="phone" type="text" class="form-control" required>
                        </div>
                      </div>
                      <?php
                            $sql = "SELECT email from users WHERE username = '$_SESSION[uname]' ";
                            $run = mysqli_query($data, $sql);
                            $row = mysqli_fetch_assoc($run);
                      ?>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input name="email" value="<?= $row['email'] ?>"  type="email" class="form-control" required>
                        </div>
                      </div>
                    </div> 
                    <div class="row">
                    <div class="col-md-6">
                        <select class="form-control" aria-label="Default select example">
                            <option value="1">Cash on Delivery</option>
                        </select>
                    </div>
                    </div> 
                    <!-- /.row-->
                  </div>
                  <div class="box-footer d-flex justify-content-between"><a href="userCart.php" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Back to Cart</a>
                    <button type="submit" name="addorder" class="btn btn-primary">Continue to Delivery Method<i class="fa fa-chevron-right"></i></button>
                  </div>
                </form>
              </div>
              <!-- /.box-->
            </div>
            <?php 
                $total = 0;
                if(isset($_SESSION['cart'])) {
                    foreach($_SESSION['cart'] as $key => $value) {
                        $total = $total + $value['productQuantity'] * $value['productPrice'];
                    }
                }
            ?>
            <div class="col-lg-3">
              <div id="order-summary" class="card">
                <div class="card-header">
                  <h3 class="mt-4 mb-4">Order summary</h3>
                </div>
                <div class="card-body">
                  <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>Order subtotal</td>
                          <th>$<?php echo $total ?></th>
                        </tr>
                        <tr>
                          <td>Shipping and handling</td>
                          <th>$10.00</th>
                        </tr>
                        <tr>
                          <td>Tax</td>
                          <th>$0.00</th>
                        </tr>
                        <tr class="total">
                          <td>Total</td>
                          <th>$<?php echo $total+10;  ?></th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            </div>
        </div>
    </div>
</div>

<?php
    include("footer.php");
?>