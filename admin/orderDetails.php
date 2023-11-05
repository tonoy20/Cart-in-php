<?php
include("../server.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <title>Document</title>
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
                            <th width="5%" scope="col">Order No</th>
                            <th width="10%" scope="col">User name</th>
                            <th width="15%" scope="col">User Email</th>
                            <th width="10%" scope="col">total price</th>
                            <th width="10%" scope="col">Address</th>
                            <th width="15%" scope="col">Payment Method</th>
                            <th width="15%" scope="col">Date</th>
                            <th width="10%" scope="col">Order Status</th>
                            <th width="15%" scope="col"></th>
                        </tr>
                    </thead>
                    <?php
                    // order products table
                    $sql1 = "SELECT * FROM orders";
                    $srun1 = mysqli_query($data, $sql1);
                    while ($row1 = mysqli_fetch_assoc($srun1)) {
                    ?>
                        <tbody class="bg-white">
                            <tr class="align-middle">
                                <td><a class="btn btn-secondary" href="orderProductDetails.php?or=<?php echo $row1['id'] ?>"><?php echo $row1['id'] ?></a></td>
                                    <!-- user table -->
                                    <?php
                                    $sql4 = "SELECT * FROM users WHERE id = $row1[user_id]";
                                    $srun4 = mysqli_query($data, $sql4);
                                    while ($row4 = mysqli_fetch_assoc($srun4)) {
                                    ?>
                                        <td><?php echo $row4['username'] ?></td>
                                        <td><?php echo $row4['email'] ?></td>
                                    <?php
                                    }
                                    ?>
                                    <td>$<?php echo $row1['total_amount'] ?></td>
                                    <td><?php echo $row1['address'] ?></td>
                                    <td><?php echo $row1['payment_status'] ?></td>
                                    <td><?php echo $row1['order_date'] ?></td>
                                    <td><?php if ($row1['status'] == 0) echo "pending";
                                        else if ($row1['status'] == 1) {
                                            echo "processing";
                                        } else {
                                            echo "successful";
                                        }
                                        ?></td>
                                    <td>
                                        <form action="orderCrud.php?su=<?php echo $row1['id'] ?>" method="POST">
                                            <select name="process">
                                                <option value="" disabled selected>Choose option</option>
                                                <option value="1">processing</option>
                                                <option value="2">Completed</option>
                                            </select>
                                            <button class="btn btn-primary" type="submit" name="su">action</button>
                                        </form>
                                    </td>
                                <?php
                                }
                                ?>
                            </tr>
                        </tbody>
                    
                </table>
            </div>
        </div>
    </main>
    <?php
    include("includes/footer.php");
    ?>
</body>

</html>