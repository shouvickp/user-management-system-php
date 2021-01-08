<?php
	
	require "connect.php";

	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$city = $_POST['city'];
	$gender = $_POST['gender'];

	$target_directory = "profilepic/";
	$target_file = $target_directory.basename($_FILES["file"]["name"]);   //name is to get the file name of uploaded file
	$filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$newfilename = $target_directory.$_FILES["file"]["name"];

	$hashed_pass = md5($pass);
	$q = "select * from user where email='$email'";
	$res = mysqli_query($conn, $q);
	if(mysqli_num_rows($res) == 0) {
		$query = "insert into user values ('$email', '$hashed_pass', '$gender', '$target_file', '$city')";
		if(mysqli_query($conn, $query)){
			move_uploaded_file($_FILES["file"]["tmp_name"],$newfilename); 
		  	echo "Successfully registered. login now";
		}
		else 
			echo 0;
	}
	else
		echo -1;
	