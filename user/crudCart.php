<?php
    session_start();
    $prod_id = $_POST['pid'];
    $prod_name = $_POST['pname'];
    $prod_price = $_POST['pprice'];
    $prod_qu = $_POST['pquantity'];


    if(isset($_POST['addCart'])) {
        //check products
        // if(isset($_SESSION['cart'])) {
        //     $check_product = array_column($_SESSION['cart'],'productName');
        //     if(in_array($prod_name, $check_product)) {
                
        //     }
        // }   
        $_SESSION['cart'][] = array( 'productID' => $prod_id,'productName' => $prod_name,
        'productPrice' => $prod_price,
        'productQuantity' => $prod_qu);
        header("location:userCart.php");  
    }
?>