<?php
    session_start();
    //Delete Cart
    if(isset($_POST['remove'])) {
        foreach($_SESSION['cart'] as $key => $value) {
            if($value['productID'] === $_POST['item']) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                header("location: userCart.php");
            }
        }
    }
    //Update Cart
    if(isset($_POST['update'])) {
        foreach($_SESSION['cart'] as $key => $value) {

            if($value['productID'] === $_POST['item']) {
                $_SESSION['cart'][$key] = array( 'productID' => $_POST['item'],
                'productName' => $_POST['upname'],
                'productPrice' => $_POST['uprice'],
                'productQuantity' => $_POST['upQuantity']);;
                header("location: userCart.php");
            }
        }
    }
?>