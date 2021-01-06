<?php
	require "./connect.php";
    if(!isset($_SESSION)){
        session_start();
    }
    //fetching the image from the form
	$newimg = mysqli_real_escape_string($conn,'profilepic/'.$_FILES['imageFile']['name']);
	$email = $_SESSION["email"];
	$query="select profilepic from user where email='$email'";
	$result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $oldimg = $row['profilepic'];

    $query = "UPDATE user SET profilepic = '$newimg' WHERE email = '$email'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    move_uploaded_file($_FILES["imageFile"]["tmp_name"], $newimg);
    unlink($oldimg);

	header("location: welcome.php?message=success");
?>