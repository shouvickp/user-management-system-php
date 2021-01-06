<?php
 	require "./connect.php";
    if(!isset($_SESSION)){
        session_start();
    }
 ?>
 <?php
 	$email = mysqli_real_escape_string($conn, $_POST["email"]);
	$password = mysqli_real_escape_string($conn, $_POST["password"]);
	$hashed_password = md5($password);
	if(!empty($_POST['usertype'])) {
			      	$usertype=$_POST['usertype'];
			}
	if($usertype === 'customer'){
		$query = "SELECT * FROM user WHERE email = '$email' AND password = '$hashed_password'";
	    $query_result = mysqli_query($conn, $query);

	    if(mysqli_num_rows($query_result) == 0) {
	        echo "User account does not exists.";
	    }
	    else {
	        $row = mysqli_fetch_array($query_result);
	        $_SESSION["email"] = $email;
	        // redirect to welcome page
	        // header("location: welcome.php");
	        echo "1";
	    }
	}
	if($usertype === 'admin'){
		$query = "SELECT * FROM admin WHERE email = '$email' AND password = '$hashed_password'";
	    $query_result = mysqli_query($conn, $query);

	    if(mysqli_num_rows($query_result) == 0){
	        echo "Admin account does not exists.";
	    }else{
	        $row = mysqli_fetch_array($query_result);
	        $_SESSION["email"] = $email;
	        // header("location: admin_panel.php");
	        echo "2";
	    }
	}
	
 ?>