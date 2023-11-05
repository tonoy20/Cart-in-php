<?php
    include("../server.php");
?>
<?php
    if(isset($_POST['review_submit'])) {
        $rating = $_POST['rating'];
        $review = $_POST['review'];
        $prod_id = $_GET['pro'];
        $user_id = $_GET['uid'];
        $added_on = date('Y-m-d h:i:s');
        $sql1 = "INSERT INTO `product_reviews`(`product_id`, `user_id`, `rating`, `review`, `status`, `added_on`) VALUES ('$prod_id','$user_id','$rating','$review','0', '$added_on')";
        $res1 = mysqli_query($data, $sql1);
        if($res1) {
            header("location: productDetail.php?re=$prod_id");
        }
    }
?>