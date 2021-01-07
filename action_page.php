<?php
    require "./connect.php";
    if(!isset($_SESSION)){
        session_start();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>response</title>
</head>
<body>
	<?php
		//fectching the field values from the html form
		$email = mysqli_real_escape_string($conn, $_POST["uemail"]);
		$password = mysqli_real_escape_string($conn, $_POST["psw"]);
		$confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_psw"]);
		if(!empty($_POST['gender'])) {
		      	$gender=$_POST['gender'];
		}
		$img = mysqli_real_escape_string($conn,'profilepic/'.$_FILES['fileToUpload']['name']);
		$city = mysqli_real_escape_string($conn,$_POST["city"]);
		//encrypting the passwod using md5 encryption technique
		$hashed_password = md5($password);
		//preparing the insert query statement
		$query = "INSERT INTO user (email, password, gender, profilepic, city) VALUES ('$email', '$hashed_password', '$gender', '$img','$city')";
		//checking whether the password matches	
		if($password !== $confirm_password)
		{
			echo "Password and Confirm password doesnot matched.";
		}
		else {
			// perform query operation
			if(mysqli_query($conn, $query)){
				$_SESSION["email"] = $email;
				//uploading the image to profilepic directory
				if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $img)) {
					//redirecting to login.php page
					header("location: login.html");
				}
				else{
					echo "Profile image not uploaded";
				}				
			}
			else {
				echo "Sorry! some error occurs! try agin later.";
			}			
		}
	?>
</body>
</html>