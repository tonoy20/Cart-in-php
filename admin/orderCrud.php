<?php
    include("../server.php");
?>
<?php
    if(isset($_GET['su'])) {
        $order_id = $_GET['su'];
        if(!empty($_POST['process'])) {
            $select = $_POST['process'];
             $sadd = "UPDATE `orders` SET `status`= '$select' WHERE id = $order_id";
             $rad = mysqli_query($data, $sadd);
            if($rad) {
               header('location: orderDetails.php');
        }
    }
}
?>