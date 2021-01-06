<?php
	require "./connect.php";
    if(!isset($_SESSION)){
        session_start();
    }
    //fetching the image from the form
	$newimg = mysqli_real_escape_string($conn,'profilepic/'.$_FILES['imageFile']['name']);
    //fetching email from session variable
	$email = $_SESSION["email"];
    //query to update profilepic
	$query="select profilepic from user where email='$email'";
    //executing the query
	$result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $oldimg = $row['profilepic'];

    $query = "UPDATE user SET profilepic = '$newimg' WHERE email = '$email'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    //deleting the new image to the directory profilepic
    move_uploaded_file($_FILES["imageFile"]["tmp_name"], $newimg);
    //deleting the old image from the directory profilepic
    unlink($oldimg);
    //on successfully upadate image redirect to customer dashboard
	header("location: welcome.php?message=success");
?>