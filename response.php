<?php
	require "./connect.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Success Page</title>
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<div class="container">
		<?php
			$email=$_SESSION["email"];
			$query="select * from user where email='$email'";
			$query_result = mysqli_query($conn, $query);
			if ($query_result->num_rows > 0) {
			  $row = $query_result->fetch_assoc();
			  $img = $row["profilepic"];
			}
		?>
		<img src="<?php echo $img ?>" id="profilepic" alt="Avatar" class="avatar"><br>
		<b>Hi, <?php echo "Email: ".$row["email"]?></b><br>
		<h2> welcome to Techmonastic</h2><hr>
		<b><?php echo "Gender: ".$row["gender"]?></b><br>
		<b><?php echo "City: ".$row["city"]?></b><br>
	</div>
</body>
</html>