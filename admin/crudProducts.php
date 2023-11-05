<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<?php
include("../server.php");

function image_upload($img)
{
    $tmp_loc = $img['tmp_name'];
    $new_name = random_int(11111, 99999) . $img['name'];

    $new_loc = UPLOAD_SRC . $new_name;
    if (!move_uploaded_file($tmp_loc, $new_loc)) {
        header("location: showProducts.php?alert=img_upload_failed");
        exit;
    } else {
        return $new_name;
    }
}


if (isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($data, $_POST['name']);
    $brand = mysqli_real_escape_string($data, $_POST['brand']);
    $price = mysqli_real_escape_string($data, $_POST['price']);
    $quantity = mysqli_real_escape_string($data, $_POST['quantity']);
    $color = mysqli_real_escape_string($data, $_POST['color']);
    $size = mysqli_real_escape_string($data, $_POST['size']);

    $img_path = image_upload($_FILES['image']);

    $query1 = "INSERT INTO `products`(`name`, `brand`, `price`, `quantity`, `color`, `size`,`image`) VALUES ('$name','$brand','$price','$quantity','$color','$size','$img_path')";

    $q_run =  mysqli_query($data, $query1);

    $productID = mysqli_insert_id($data);
    $categoryID = $_POST['productCategory'];

    // multiple image upload
    if (isset($_FILES['product_images']['name'])) {
        foreach ($_FILES['product_images']['name'] as  $key => $val) {
            $imgs = rand(11111, 99999) . $_FILES['product_images']['name'][$key];
            move_uploaded_file($_FILES['product_images']['tmp_name'][$key], MULTIPLE_IMG . $imgs);
            mysqli_query($data, "INSERT INTO `product_galary`(`product_id`, `images`) VALUES ('$productID','$imgs')");
        }
    }

    foreach ($categoryID as $catID) {
        $query2 = "INSERT INTO `product_categories` (`product_id`,`category_id` ) VALUES ('$productID', '$catID')";
        $query_run = mysqli_query($data, $query2);
        if ($query2) {
            header("location: showProducts.php?success=added");
        } else {
            header("location: showProducts.php?alert=add_failed");
        }
    }
}

function image_remove($img)
{
    if (!unlink(UPLOAD_SRC . $img)) {
        header("location:showProducts.php?alert=img_remove_failed");
        exit;
    }
}

if (isset($_GET['del'])) {
    $qimg = "SELECT * FROM `products` WHERE `id` = $_GET[del]";
    $resimg = mysqli_query($data, $qimg);
    $fetch = mysqli_fetch_assoc($resimg);

    image_remove($fetch['image']);

    $query1 = "DELETE FROM `product_categories` WHERE product_id = $_GET[del]";
    $res1 = mysqli_query($data, $query1);


    $query2 = "DELETE FROM `products` WHERE id = $_GET[del]";
    $res1 = mysqli_query($data, $query2);
    if ($res1) {
        header("location:showProducts.php?success=deleted");
    }
}

// Delete multiple
if (isset($_GET['mid']) && $_GET['mid'] > 0) {
    $mid1 =  $_GET['mid'];
    $sqlimg1 = "SELECT * FROM product_galary WHERE id = '$mid1'";
    $resimg1 = mysqli_query($data, $sqlimg1);
    $fetchimg = mysqli_fetch_assoc($resimg1);
    unlink(MULTIPLE_IMG . $fetchimg['images']);

    $sqli = "DELETE FROM product_galary WHERE id = '$mid1'";
    $resi = mysqli_query($data, $sqli);
    $pid1 = $_GET['pid'];
    if ($resi) {
        header("location: editProducts.php?edi=$pid1");
    }
}

// edit product
if (isset($_POST['edit_product'])) {
    $prod_id = mysqli_real_escape_string($data, $_POST['prod_id']);
    // echo $prod_id;
    $name = mysqli_real_escape_string($data, $_POST['name']);
    $brand = mysqli_real_escape_string($data, $_POST['brand']);
    $price = mysqli_real_escape_string($data, $_POST['price']);
    $quantity = mysqli_real_escape_string($data, $_POST['quantity']);
    $color = mysqli_real_escape_string($data, $_POST['color']);
    $size = mysqli_real_escape_string($data, $_POST['size']);

    // image edit
    if (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {
        $qimg = "SELECT * FROM `products` WHERE `id` = $prod_id";
        $resimg = mysqli_query($data, $qimg);
        $fetch = mysqli_fetch_assoc($resimg);

        image_remove($fetch['image']);
        $imgPath = image_upload($_FILES['image']);

        $query1 = "UPDATE `products` SET `name`='$name',`brand`='$brand',`price`='$price',`quantity`='$quantity',`color`='$color',`size`='$size', `image` ='$imgPath'  WHERE `id` = '$prod_id' ";
    } else {
        $query1 = "UPDATE `products` SET `name`='$name',`brand`='$brand',`price`='$price',`quantity`='$quantity',`color`='$color',`size`='$size'  WHERE `id` = '$prod_id' ";
    }
    // $img_path = image_upload($_FILES['image']);

    $query1_run = mysqli_query($data, $query1);

    // multiple images Update
    if (isset($_FILES['product_images']['name'])) {
        foreach ($_FILES['product_images']['name'] as $key => $val) {
             if ($_FILES['product_images']['name'][$key] != '') {
                if (isset($_POST['images_id'][$key])) {
                    $imgs = rand(11111, 99999) . $_FILES['product_images']['name'][$key];
                    move_uploaded_file($_FILES['product_images']['tmp_name'][$key], MULTIPLE_IMG . $imgs);
                    mysqli_query($data, "UPDATE product_galary SET images = '$imgs' WHERE id = '".$_POST['images_id'][$key]."' ");
                } else {
                    $imgs = rand(11111, 99999) . $_FILES['product_images']['name'][$key];
                    move_uploaded_file($_FILES['product_images']['tmp_name'][$key], MULTIPLE_IMG . $imgs);
                    mysqli_query($data, "INSERT INTO `product_galary`(`product_id`, `images`) VALUES ('$prod_id','$imgs')");
                }
             }
        }
    }


    $categoryID = $_POST['edit_Pcategory'];

    $catq1 = "SELECT * FROM product_categories WHERE product_id = '$prod_id' ";
    $catqrun1 = mysqli_query($data, $catq1);

    $productCat = []; // store category by product id
    foreach ($catqrun1 as $run1) {
        $productCat[] = $run1['category_id'];
    }

    // insert new category
    foreach ($categoryID as $catID) {
        if (!in_array($catID, $productCat)) {
            // echo $catID. "Inserted"; 
            $inq = "INSERT INTO product_categories (product_id,category_id) VALUES ('$prod_id', '$catID')";
            $inq_run = mysqli_query($data, $inq);
        }
    }
    // Delete unselected category
    foreach ($productCat as $proCat) {
        if (!in_array($proCat, $categoryID)) {
            // echo $proCat."Deleted";
            $delq = "DELETE FROM product_categories WHERE product_id = '$prod_id' AND category_id = '$proCat' ";
            $delq_run = mysqli_query($data, $delq);
        }
    }
    header("location:showProducts.php");
}
