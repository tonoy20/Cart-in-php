<?php

$host="localhost";
$user="root";
$password="";
$email="";
$username ="";
$db="shoppingcart";


$data=mysqli_connect($host,$user,$password,$db);

if($data===false)
{
	die("connection error");
}


define("UPLOAD_SRC",$_SERVER['DOCUMENT_ROOT']."/cart/uploads/");

define("MULTIPLE_IMG",$_SERVER['DOCUMENT_ROOT']."/cart/uploads/product_galary/");

define("FETCH_SRC","http://127.0.0.1/cart/uploads/");

define("FETCH_MULTIPLE","http://127.0.0.1/cart/uploads/product_galary/");

?>