<?php
include("../server.php");
include("includes/header.php");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/table1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<?php
include("includes/sidebar.php");
?>
<body>
    <!-- Reviews table -->
    <main role="main">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead class="">
                            <tr>
                                <th scope="col">user id</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Reviews</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql1 = "SELECT * FROM product_reviews";
                        $res1 = mysqli_query($data, $sql1);
                        while ($row1 = mysqli_fetch_assoc($res1)) {
                            $user_id = $row1['user_id'];
                        ?>
                            <tbody>
                                <tr>
                                    <?php 
                                        $sql2 = "SELECT * FROM users WHERE id =$row1[user_id]";
                                        $res2 = mysqli_query($data, $sql2);
                                        while($row2 = mysqli_fetch_assoc($res2)) {
                                    ?>
                                        <td><?php echo $row2['email'] ?></td>
                                    <?php 
                                        } 
                                    ?>
                                    <?php 
                                        $sql3 = "SELECT * FROM products WHERE id =$row1[product_id]";
                                        $res3 = mysqli_query($data, $sql3);
                                        while($row3 = mysqli_fetch_assoc($res3)) {
                                    ?>
                                        <td><?php echo $row3['name'] ?></td>
                                    <?php
                                        }
                                    ?>
                                    <td><?php echo $row1['rating'] ?></td>
                                    <td><?php echo $row1['review'] ?></td>
                                    <td><?php if ($row1['status'] == 1) {
                                            echo "Approved";
                                        } else {
                                            echo "Pending";
                                        } ?>
                                    </td>
                                    <td>
                                        <a href="crudCmnts.php?ad=<?php echo $row1['id'] ?>"><button type="button" name="add" class="btn btn-primary">Add</button></a>
                                        <a onclick="return confirm('Are you sure?')" href="crudCmnts.php?del=<?php echo $row1['id'] ?>"><button type="button" name="delete" class="btn btn-danger">Delete</button></a>
                                    </td>
                                </tr>
                            </tbody>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>

</html>