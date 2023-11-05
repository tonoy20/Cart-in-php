<?php
    include("../server.php");
    session_start();
    if(isset($_POST['addorder'])) {
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $total_amount = $_SESSION['total_amount'];
        // GET user ID
        $user_sql = "SELECT id FROM users WHERE email = '$email' ";
        $us_run = mysqli_query($data, $user_sql);
        $us_row = mysqli_fetch_assoc($us_run);
        $user_id = $us_row['id'];
        // $_SESSION['user_id'] = $user_id;
        // update phone
        $sq_p = "UPDATE `users` SET `telephone`='$phone' WHERE id = '$user_id' ";
        $p_run = mysqli_query($data, $sq_p);
        //Insert Order
        $date = date("Y-m-d");
        $sq_or = "INSERT INTO `orders`(`user_id`, `total_amount`, `payment_status`, `address`, `order_date`, `status`) VALUES ('$user_id','$total_amount','Cash on Delivery','$address','$date', 0)";
        $or_run = mysqli_query($data,$sq_or);

        $order_id = mysqli_insert_id($data);        
        // Insert into order Products table

        foreach($_SESSION['cart'] as $value) {
                $product_id = $value['productID'];
                $quantity = $value['productQuantity'];

                $sq_op = "INSERT INTO `order_products`(`order_id`, `product_id`, `quantity`) VALUES ('$order_id','$product_id','$quantity')";
                $op_run = mysqli_query($data,$sq_op);
        }
    }
        if(isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
        
    header("location:userhome.php");
?>