<?php  
	require "connect.php";
	$id = $_POST["id"];
	$sql = "DELETE FROM user WHERE email = '$id'";
	$q = "select profilepic from user where email='$id'";
    $res = mysqli_query($conn, $q);
    $row = mysqli_fetch_assoc($res);
    $imgurl = $row['profilepic'];  
	if(mysqli_query($conn, $sql))  
	{  
		unlink($imgurl);
		echo 'Data Deleted successfully.';  
	}
	else{
		echo 'Data Deleted successfully.';
	}  
 ?>