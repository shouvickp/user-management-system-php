<?php
	require './connect.php';
	// check  if logged in
	if(!isset($_SESSION["email"])){
		header("location: index.php");
    }
    else {
        // get user details
        $email = $_SESSION["email"];
        //get old password
        $old_password = md5(mysqli_real_escape_string($conn, $_POST["old_pass"]));
        // get the newly typed password
        $new_password = md5(mysqli_real_escape_string($conn, $_POST["new_pass"]));
        //checking the old password provided is matching with database or not
        $query = "select password from user WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        if($old_password !== $row['password']){
            echo -1;
        }
        else{
            
            //if matches the updating into the database
            $query = "UPDATE user SET password = '$new_password' WHERE email = '$email'";

            if($result = mysqli_query($conn, $query)) {

                echo "sucessfully changed password, login with new passsword.";
            }
            else{
                echo 0;
            }

        }
        
    }