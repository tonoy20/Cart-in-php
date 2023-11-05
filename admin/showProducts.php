<?php
include("../server.php");
include("sessionAd.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/table.css">
    <title>show products</title>
</head>

<body>
    <?php
    include("includes/header.php");
    ?>
    <?php
    include("includes/sidebar.php");
    ?>
    <!-- Button add product -->
    <main role="main">
        <div class="container-sm pt-2" style="text-align:right">
            <a class="btn btn-success ps-5 pe-5 pt-2 pb-2" href="addproduct.php">Add product</a>
        </div>
        <div class="container mt-5">

            <div class="">
                <table class="fi-table">
                    <thead class="bg-dark text-white">
                        <tr class="">
                            <th width="10%" scope="col">product no</th>
                            <th width="15%" scope="col">name</th>
                            <th width="15%" scope="col">Category Name</th>
                            <th width="15%" scope="col">Brand</th>
                            <th width="10%" scope="col">price</th>
                            <th width="10%" scope="col">quantity</th>
                            <th width="10%" scope="col">color</th>
                            <th width="10%" scope="col">size</th>
                            <th width="35%" scope="col">image</th>
                            <th width="10%" scope="col"></th>
                            <th width="10%" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <?php
                        $sql = "SELECT p.id, ptc.category_id 
                FROM products p
                JOIN product_categories ptc ON p.id = ptc.product_id GROUP BY p.id";
                        $res = mysqli_query($data, $sql);
                        $row = mysqli_fetch_assoc($res);
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($res)) {
                            $prod_id =  $row['id'];
                            // $cat_id =  $row['category_id'];
                            $prod_id2 = -1;
                            // echo $row['category_id'];
                            $query = "SELECT * FROM `products` WHERE `id` = $prod_id";
                            $result = mysqli_query($data, $query);
                            $fetch_src = FETCH_SRC;
                            //relational table category id fetch
                            $sql1 = "SELECT GROUP_CONCAT(title) as tit FROM categories 
                    WHERE id IN
                    (SELECT category_id FROM product_categories WHERE product_id = $prod_id)";
                            $result2 = mysqli_query($data, $sql1);
                            $row2 = mysqli_fetch_assoc($result2);

                            while ($fetch = mysqli_fetch_assoc($result)) {
                                $prod_id2 = $fetch['id'];
                        ?>
                                <tr class="align-middle">
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $fetch['name'] ?></td>
                                    <td><?php echo $row2['tit'] ?></td>
                                    <td><?php echo $fetch['brand'] ?></td>
                                    <td>$<?php echo $fetch['price'] ?></td>
                                    <td><?php echo $fetch['quantity'] ?></td>
                                    <td><?php echo $fetch['color'] ?></td>
                                    <td><?php echo $fetch['size'] ?></td>
                                    <td><img src=<?= "$fetch_src$fetch[image]" ?>  width="150px"></td>
                                    <td><a href="editProducts.php?edi=<?= $prod_id2; ?>"><button class="btn btn-info">Edit</a></button></td>
                                    <td><a href="crudProducts.php?del=<?= $prod_id2; ?>"><button class="btn btn-danger">Delete</a></button></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
<?php include("includes/footer.php"); ?>
</html>