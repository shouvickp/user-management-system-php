<?php
	require "./connect.php";
    if(!isset($_SESSION)){
        session_start();
    }
    //fetching the image from the form
	$newcity =  mysqli_real_escape_string($conn,$_POST["city"]);
	$email = $_SESSION["email"];
	$query = "UPDATE user SET city = '$newcity' WHERE email = '$email'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	header("location: welcome.php?message=success");
?>