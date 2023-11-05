<?php
include("../server.php");
include("sessionAd.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <title>Edit product</title>
</head>

    <header>
        <?php
        include("../header.php");
        ?>
    </header>
    <!-- edit product fetch -->
    <?php
    $fetch_src = FETCH_SRC;
    $product_id = $_GET['edi'];
    $name = "";
    $brand = "";
    $price = "";
    $quantity = "";
    $color = "";
    $size = "";
    $image_p = "";
    $cat_array = [];
    $MultipleImg = [];
    if (isset($_GET['edi'])) {
        $query = "SELECT * FROM `products` WHERE id = $product_id";
        $result = mysqli_query($data, $query);
        while ($fetch = mysqli_fetch_assoc($result)) {
            $name = $fetch['name'];
            $brand = $fetch['brand'];
            $price = $fetch['price'];
            $quantity = $fetch['quantity'];
            $color = $fetch['color'];
            $size = $fetch['size'];
            $image_p = $fetch_src . $fetch['image'];
        }
        $resMultipleImg = mysqli_query($data, "SELECT id,images FROM product_galary WHERE product_id = '$product_id' ");
        if (mysqli_num_rows($resMultipleImg) > 0) {
            $j = 0;
            while ($rowsImgs = mysqli_fetch_assoc($resMultipleImg)) {
                $MultipleImg[$j]['images'] = $rowsImgs['images'];
                $MultipleImg[$j]['id'] = $rowsImgs['id'];
                $j++;
            }
        }
    }
    ?>

    <body>
        <h1 style="text-align: center;">Edit Product</h1>
        <div class="container w-50 border mt-5 ">
            <form class="mt-5" action="crudProducts.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Product Brand</label>
                    <input type="text" class="form-control" name="brand" value="<?php echo $brand; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">price</label>
                    <input type="number" class="form-control" name="price" value="<?php echo $price; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Stock Quantity</label>
                    <input type="number" class="form-control" name="quantity" value="<?php echo $quantity; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Color</label>
                    <input type="text" class="form-control" name="color" value="<?php echo $color; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Size</label>
                    <input type="text" class="form-control" name="size" value="<?php echo $size; ?>">
                </div>
                <!-- category select -->
                <?php
                $query2 = "SELECT `category_id` FROM `product_categories` WHERE `product_id` = $product_id";
                $result2 = mysqli_query($data, $query2);
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    array_push($cat_array, $row2['category_id']);
                }
                // for($x=0; $x<count($cat_array); $x++) {
                //     echo $cat_array[$x]."\n";
                // }
                ?>
                <div class="mb-3">
                    <label for="">--Category Select--</label>
                    <select name="edit_Pcategory[]" multiple="multiple" class="ms-1 d-block w-100">
                        <?php
                        $category = mysqli_query($data, "SELECT id, title from categories");
                        foreach ($category as $row) {
                        ?>
                            <option value="<?= $row['id']; ?>" <?php echo in_array($row['id'],    $cat_array) ? 'selected' : '' ?>>
                                <?= $row['title']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <img src="<?= $image_p ?>" name="editimg" width="40%" class="mb-3">
                <div class="mb-3">
                    <label for="" class="form-label">Product Image</label>
                    <input type="file" class="form-control" name="image" accept="jpg,.png,.svg,.webp">
                </div>
                <!-- add more images button -->
                <div id="image_box">
                    <div class="mb-3 col-lg-2">
                        <label for="" class="form-label"></label>
                            <button type="button" onclick="add_more_images()" class="btn btn-secondary text-white btn-outline-success form-control">Add More Images</button>
                    </div>
                </div>
                <!-- multiple image show -->
                <?php
                if (isset($MultipleImg[0])) {
                    foreach ($MultipleImg as $list) {
                        echo '<div id="add_image_box_'.$list['id'].'"><label for="" class="form-label"></label><input type="file" class="form-control" name="product_images[]" accept="jpg,.png,.svg,.webp"><a style="color:white" href="crudProducts.php?pid='.$product_id.'&mid='.$list['id'].'"><button type="button" class="btn btn-danger text-white btn-outline-success form-control" >Remove</button></a>';
                        echo "<a target='_blank' href='".FETCH_MULTIPLE.$list['images']."'><img height='150px' width='150px' src='".FETCH_MULTIPLE.$list['images']."' /></a>";
                        echo '<input type="hidden" name="images_id[]" value="'.$list['id'].'" /></div>';
                    }
                }
                ?>
                <input type="hidden" name="prod_id" id="prod_id" value="<?= $product_id; ?>">
                <div class="d-flex justify-content-center">
                    <button type="submit" name="edit_product" class="btn btn-success text-white btn-outline-success form-control w-50 m-3">Edit Stock</button>
                </div>
            </form>
        </div>
        <script>
            var total_image = 1;
            function add_more_images() {
                total_image++;
                    var html = '<div class="mb-3 col-lg-6" id="add_image_box_'+total_image+'"><label for="" class="form-label">Product Image</label><input type="file" class="form-control" name="product_images[]" accept="jpg,.png,.svg,.webp"><button type="button" class="btn btn-danger text-white btn-outline-success form-control" onClick=remove_image("'+total_image+'")>Remove</button></div>';
                jQuery('#image_box').append(html);
            }
            function remove_image(id) {
                jQuery('#add_image_box_'+id).remove();
            }
        </script>
    </body>
</html>