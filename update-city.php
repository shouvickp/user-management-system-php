<?php
	require "./connect.php";
    if(!isset($_SESSION)){
        session_start();
    }
    //fetching the city from the form
	$newcity =  mysqli_real_escape_string($conn,$_POST["city"]);
	//fetching email from session variable
	$email = $_SESSION["email"];
	//query to update city
	$query = "UPDATE user SET city = '$newcity' WHERE email = '$email'";
	//executing the query if any error ocuurs the destroying the connection
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    //on successfully upadate city redirect to customer dashboard
	header("location: welcome.php?message=success");
?>