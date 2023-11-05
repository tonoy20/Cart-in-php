<?php
    include("../server.php");
?>
<?php
    if(isset($_GET['ad'])) {
        $user_id = $_GET['ad'];
        $sadd = "UPDATE `users` SET `status`= 1 WHERE id = $user_id";
        $rad = mysqli_query($data, $sadd);
        if($rad) {
            header('location: manageUser.php');
        }
    }
    if(isset($_GET['del'])) {
        $user_id = $_GET['del'];
        $sdel = "DELETE FROM `users` WHERE id = '$user_id' ";
        $rdel = mysqli_query($data, $sdel);
        if($rdel) {
            header("location: manageUser.php");
        }
    }
?>