<?php
include("../server.php");
include("includes/header.php");
?>
<!DOCTYPE html>
<html lang="en">

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
    <!-- User table -->
    <main role="main">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead class="">
                            <tr>
                                <th scope="col">Email</th>
                                <th scope="col">Username</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <?php
                        $sql = "SELECT * FROM users WHERE userType = 1";
                        $res = mysqli_query($data, $sql);
                        while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php if ($row['status']) {
                                            echo "Approved";
                                        } else {
                                            echo "Pending";
                                        } ?></td>
                                    <td>
                                        <a href="crudUser.php?ad=<?php echo $row['id'] ?>"><button type="button" name="add" class="btn btn-primary">Add</button></a>
                                        <a onclick="return confirm('Are you sure?')" href="crudUser.php?del=<?php echo $row['id'] ?>"><button type="button" name="delete" class="btn btn-danger">Delete</button></a>
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
    <?php
    include("includes/footer.php");
    ?>
</body>

</html>