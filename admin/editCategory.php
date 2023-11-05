<?php
include("../server.php");
include("sessionAd.php");


$name = "";
$description = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * from categories WHERE id=$id";
    $sel = mysqli_query($data, $sql);
    $row = mysqli_fetch_assoc($sel);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Admin Edit category</title>
</head>

<body>
    <div class="container">
        <h2>Edit Category</h2>

        <form method="POST" action="crudcategory.php">
            <div class="form-group">
                <label>category title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $row['title'] ?>">
            </div>
            <div class="form-group">
                <label>category description</label>
                <textarea type="text" name="description" class="form-control"> <?php echo $row['description'] ?></textarea>
            </div>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="modal-footer">
                <a href="adminhome.php">Back </a>
                <input type="submit" name="edit" class="btn btn-success">
            </div>
        </form>
    </div>

</body>

</html>