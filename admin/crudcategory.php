<?php

require("../server.php");
include("sessionAd.php");



// Add Category

if (isset($_POST['addCategory'])) {
    // print_r($_POST);
    $title = mysqli_real_escape_string($data, $_POST['title']);
    $description = mysqli_real_escape_string($data, $_POST['description']);
    //  $query = "INSERT INTO `categories`( `title`, `description`,`cat_state`) VALUES ('$_POST[title]','$_POST[description]', 1)";
    $sql = "SELECT * from categories WHERE title='" . $title . "' ";
    $res1 = mysqli_query($data, $sql);
    $res = mysqli_fetch_array($res1);

    // if(mysqli_query($data,$query)) {
    if ($res['cat_state'] == 1) {
        header("location:adminhome.php?alert=add_failed");
    } else {
        $query = "INSERT INTO `categories`( `title`, `description`,`cat_state`) VALUES ('$title','$_POST[description]', 1)";
        mysqli_query($data, $query);
        header("location:adminhome.php?success=added");
    }
}

// Delete Catergory
if (isset($_GET['rem']) && $_GET['rem'] > 0) {
    $qu = "SELECT * FROM `categories` WHERE `id`='$_GET[rem]' ";
    $re = mysqli_query($data, $qu);
    $fetch = mysqli_fetch_assoc($re);

    $qu1 = "DELETE FROM `categories` WHERE `id`='$_GET[rem]' ";
    if (mysqli_query($data, $qu1)) {
        header("location: adminhome.php?succeed=removed");
    } else {
        header("location: adminhome.php?alert=remove_failed");
    }
}

//edit Category

if (isset($_POST['edit'])) {
    $title = mysqli_real_escape_string($data, $_POST["title"]);
    $description = mysqli_real_escape_string($data, $_POST["description"]);
    $id = mysqli_real_escape_string($data, $_POST['id']);
    $usql = "UPDATE `categories` SET `title`='$title',`description`='$description', `cat_state` = 1 WHERE `id` = $id";
    if (mysqli_query($data, $usql)) {
        header("location: adminhome.php?succeed=edited");
    } else {
        header("location: adminhome.php?succeed=failed");
    }
}
