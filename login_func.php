<?php

include("server.php");

session_start(); 

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$username=$_POST["username"];
	$password=md5($_POST["password"]);


	$sql="SELECT * from users WHERE username='".$username."' AND password='".$password."' ";

	$result=mysqli_query($data, $sql);

	$row=mysqli_fetch_array($result);

	if(($row["userType"]==1) && ($row['status'] == 1) && (!is_null($row)))
	{	
		$_SESSION["uname"] = $username;
		$_SESSION["upass"] = $password;
		$sql = "SELECT id FROM users WHERE username = '$username' ";
		$q_run = mysqli_query($data, $sql);
		$row = mysqli_fetch_assoc($q_run);
		$_SESSION['user_id'] = $row['id'];
		header("location:user/userhome.php");
	}

	else if(($row["userType"]==0) && ($row['username'] == $username) && ($row['username'] !== NULL))
	{
		$_SESSION["uname"] = $username;
		$_SESSION["upass"] = $password;
		header("location:admin/adminhome.php");
	}

	else if(($username == '') && ($password == '') )
	{
		header("location:login.php");
	}
	else {
		header("location:login.php");
	}

}
?>