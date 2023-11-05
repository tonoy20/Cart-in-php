<?php
include("topbar.php");
?>
<div id="all">
    <div id="content">
        <div class="container">
            <div class="row">
                <h2 class="container-fluid text-center"><?php
                                                        echo $_SESSION['uname']
                                                        ?> Orders</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <!-- <th>SI No</th> -->
                            <th>Product</th>
                            <th></th>
                            <th>Quantity</th>
                            <th>Total Cost</th>
                            <th>Payment Status</th>
                            <th>Address</th>
                            <th>Date</th>
                            <th>Order Status</th>
                        </tr>
                    </thead>
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        $user_id = $_SESSION['user_id'];
                        $or_sql = "SELECT id FROM orders WHERE user_id = '$user_id' ";
                        $or_run = mysqli_query($data, $or_sql);
                        $i = 1;
                        while ($or_row = mysqli_fetch_assoc($or_run)) {
                            
                            $sql = "SELECT * FROM orders WHERE id = $or_row[id] ";
                            $run = mysqli_query($data, $sql);
                            while ($row = mysqli_fetch_assoc($run)) {
                    ?>
                                <tbody>
                                    <tr>
                                        <!-- FETCH PRODUCT -->
                                        <?php
                                        $fetch_src = FETCH_SRC;
                                        $p_sql = "SELECT * FROM order_products WHERE order_id = $or_row[id]";
                                        $p_run = mysqli_query($data, $p_sql);
                                        while ($p_row = mysqli_fetch_assoc($p_run)) {
                                            $quantity = $p_row['quantity'];
                                            $p_sql2 = "SELECT * FROM products WHERE id = $p_row[product_id]";
                                            $p_run2 = mysqli_query($data, $p_sql2);
                                            while ($p_row2 = mysqli_fetch_assoc($p_run2)) {
                                        ?>
                                                <td>
                                                    <?php echo $p_row2['name'] ?>
                                                </td>
                                                <td>
                                                    <img style="width: 40px; height: 40px; 
                                                    background-color: white;
                                                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                                                    " src="<?= $fetch_src . $p_row2['image'] ?>" alt="">
                                                </td>
                                            <?php
                                            }
                                            ?>
                                            <td><?php echo $quantity ?></td>
                                       
                                        <td><?php echo $row['total_amount'] ?></td>
                                        <td><?php echo $row['payment_status'] ?></td>
                                        <td><?php echo $row['address'] ?></td>
                                        <td><?php echo $row['order_date'] ?></td>
                                        <td><?php if ($row['status'] == 0) {
                                                echo "pending";
                                            } else if ($row['status'] == 1) {
                                                echo "processing";
                                            } else if ($row['status'] == 2) {
                                                echo "successful";
                                            } ?></td>
                                    </tr>
                                    
                                </tbody>
                                <?php
                                        }
                                        ?>
                    <?php
                            }
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>