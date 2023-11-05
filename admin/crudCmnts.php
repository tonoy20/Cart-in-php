<?php
    include("../server.php");
?>
<?php
    if(isset($_GET['ad'])) {
        $cmnt_id = $_GET['ad'];
        $sql1 = "UPDATE `product_reviews` SET `status`= 1 WHERE id = $cmnt_id";
        $rad = mysqli_query($data, $sql1);
        if($rad) {
            header('location: userCmnts.php');
        }
    }
    if(isset($_GET['del'])) {
        $cmnt_id = $_GET['del'];
        $sdel = "DELETE FROM `product_reviews` WHERE id = '$cmnt_id' ";
        $rdel = mysqli_query($data, $sdel);
        if($rdel) {
            header("location: userCmnts.php");
        }
    }
?>