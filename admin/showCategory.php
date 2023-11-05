<?php
include("../server.php");
// include("sessionAd.php");
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Category</title>
</head> -->
<body>
    <div>
        <table>
            <tr>
                <th>SI No</th>
                <th>Name</th>
                <th>Description</th>
            </tr>
            <?php
            $query = "SELECT * FROM `categories`";
            $result = mysqli_query($data, $query);
            $i = 1;
            while ($fetch = mysqli_fetch_assoc($result)) {
                echo <<<category
                    <tr>
                        <td>$i</td>
                        <td>$fetch[title]</td>
                        <td>$fetch[description]</td>
                        
                        <td><button onclick="confirm_upd($fetch[id])" class="btn btn-info">Edit</button></td>
                        <td><button onclick="confirm_rem($fetch[id])" class="btn btn-danger">Delete</button></td>
                    </tr>
                category;
                $i++;
            }
            ?>
        </Table>
    </div>
    <script>
        function confirm_rem(id) {
            if (confirm("Are you sure, you want to delete?")) {
                window.location.href = "crudcategory.php?rem=" + id;
            }
        }

        function confirm_upd(id) {
            window.location.href = "editCategory.php?id=" + id;
        }
    </script>
</body>
<!-- </html> -->