<?php
include("sessionAd.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Admin create category</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <?php
    include("includes/header.php");
    ?>
    <main role="main">
        <div class="container">
            <h2 class="">Create Category</h2>
            <form action="crudcategory.php" method="POST">
                <div class="form-group">
                    <label>category title</label>
                    <input type="text" class="form-control" placeholder="title" name="title">
                </div>
                <div class="form-group">
                    <label>category description</label>
                    <textarea class="form-control" placeholder="description" rows="3" name="description"></textarea>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-dark" href="adminhome.php">Back</a>
                    <button type="submit" class="btn btn-success" name="addCategory" value="addCat">Add</button>
                </div>
            </form>
        </div>
</main>
</body>
</html>