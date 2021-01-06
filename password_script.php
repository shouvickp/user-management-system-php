<?php
	require './connect.php';
	// check  if logged in
	if(!isset($_SESSION["email"])){
		header("location: index.php");
    }else{
        // get user details
        $email = $_SESSION["email"];
        //get old password
        $old_password = md5(mysqli_real_escape_string($conn, $_POST["old_pass"]));
        // get the newly typed password
        $new_password = md5(mysqli_real_escape_string($conn, $_POST["new_pass"]));
        $retype_pass = md5(mysqli_real_escape_string($conn, $_POST["retype_new_pass"]));
        //checking the old password provided is matching with database or not
        $query = "select password from user WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        if($old_password !== $row['password']){
            echo "The old passwords provided by you  not matching Try again.";
        }
        else{
            // check if the typed new passwords matches while re entering
            if($new_password != $retype_pass){
                echo "The passwords do not match. Try again.";
            }
            else{
                //if matches the updating into the database
                $query = "UPDATE user SET password = '$new_password' WHERE email = '$email'";

                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

                echo "sucessfully changed password login with new passsword.";
            }

        }
        
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <p>go to login page from <a href="login.html"> here.</a></p>
</body>
</html>