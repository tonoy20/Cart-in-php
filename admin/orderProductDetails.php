<?php
include("../server.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include("includes/header.php");
    ?>
    <?php
    include("includes/sidebar.php");
    ?>

    <main role="main">
        <div class="container mt-5 pt-4">
            <div class="table-wrapper">
                <table class="fi-table">
                    <thead class="bg-dark text-white">
                        <tr class="">
                            <th width="10%" scope="col">product</th>
                            <th width="15%" scope="col"></th>
                            <th width="10%" scope="col">Brand</th>
                            <th width="10%" scope="col">Quantity</th>
                            <th width="10%" scope="col">total price</th>
                            <th width="15%" scope="col">Date</th>
                        </tr>
                    </thead>
                    <?php
                    $fetch_src = FETCH_SRC;
                    $total = 0;
                    $or_id = $_GET['or'];
                    $sql1 = "SELECT * FROM order_products WHERE order_id = '$or_id' ";
                    $res1 = mysqli_query($data, $sql1);
                    while ($row1 = mysqli_fetch_assoc($res1)) {
                        $sql2 = "SELECT * FROM products WHERE id = $row1[product_id] ";
                        $res2 = mysqli_query($data, $sql2);
                        while ($row2 = mysqli_fetch_assoc($res2)) {
                    ?>
                            <tbody class="bg-white ">
                                <tr class="align-middle">
                                    <td><?php echo $row2['name'] ?></td>
                                    <td><img style="width: 40px; height: 40px; 
                                                    background-color: white;
                                                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                                                    " src="<?= $fetch_src . $row2['image'] ?>" alt=""></td>

                                    <td><?php echo $row2['brand'] ?></td>
                                    <td><?php echo $row1['quantity'] ?></td>
                                    <td>$<?php echo $row1['quantity'] * $row2['price'] ?></td>
                                    <td><?php
                                        $sql3 = "SELECT total_amount,order_date FROM orders WHERE id = '$or_id' ";
                                        $res3 = mysqli_query($data, $sql3);
                                        $row3 = mysqli_fetch_assoc($res3);
                                        echo $row3['order_date'];
                                        $total = $total + $row3['total_amount'];
                                        ?></td>
                                </tr>
                            </tbody>
                    <?php
                        }
                    }
                    ?>
                    <tfoot>
                        <tr>
                            <th colspan="4">Total</th>
                            <th colspan="2">$<?php echo $total ?>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
            <div class="container text-end">
                <a class="btn btn-primary" href="orderDetails.php">Back</a>
            </div>
    </main>

</body>

</html>