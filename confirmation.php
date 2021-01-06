<?php
 	require "./connect.php";
    if(!isset($_SESSION)){
        session_start();
    }
 ?>
 <?php
 	//fetching form data
 	$email = mysqli_real_escape_string($conn, $_POST["email"]);
	$password = mysqli_real_escape_string($conn, $_POST["password"]);
	$hashed_password = md5($password);
	if(!empty($_POST['usertype'])) {
			      	$usertype=$_POST['usertype'];
	}
	//if user is a customer
	if($usertype === 'customer') {
		// making query to search whether a customer is valid or not 
		$query = "SELECT * FROM user WHERE email = '$email' AND password = '$hashed_password'";
		// executing the query
	    $query_result = mysqli_query($conn, $query);
	    //if it returns 0 rows then user not found 
	    if(mysqli_num_rows($query_result) == 0) {
	        echo "User account does not exists.";
	    }
	    //otherwise inserting email in session variable
	    else {
	        $row = mysqli_fetch_array($query_result);
	        $_SESSION["email"] = $email;
	        // returning 1 if user found in customer table
	        echo "1";
	    }
	}
	//if user is a admin
	if($usertype === 'admin') {
		// making query to search whether a admin is valid or not 
		$query = "SELECT * FROM admin WHERE email = '$email' AND password = '$hashed_password'";
		// executing the query
	    $query_result = mysqli_query($conn, $query);
	    //if it returns 0 rows then user not found
	    if(mysqli_num_rows($query_result) == 0) {
	        echo "Admin account does not exists.";
	    }
	    //otherwise inserting email in session variable
	    else {
	        $row = mysqli_fetch_array($query_result);
	        $_SESSION["email"] = $email;
	        // returning 2 if user found in admin table
	        echo "2";
	    }
	}
	
 ?>