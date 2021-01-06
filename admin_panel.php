<?php
 	require "./connect.php";
    if(!isset($_SESSION)){
        session_start();
    }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
	<style type="text/css">
		table, th, td {
		  border: 1px solid black;
		  border-collapse: collapse;
		}
		table{
			margin-left: 450px;
		}
		th, td {
		  padding: 5px;
		  text-align: center;    
		}
		#logout{
			float: right;
			display: inline;
		}
		#logout_btn{
			background-color: green;
			color: white;
		}
	</style>
</head>
<body>
	<p>
		<h2 style="text-align: center;">Admin Panel</h2>
		<a id="logout" href="logout.php"><button type="submit" id="logout_btn" name="logout_button"> Logout </button></a>
	</p>
	<hr>
	<?php
		$query = "select * from user";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 0) {
	        echo "No User  exists.";
	    }
	    else {
	    	echo "<table>";
			echo "<tr>
				<th>User Email</th>
				<th>Gender</th>
				<th>City</th>
				<th>Photo</th>
				<th>Manage</th>
				</tr>";
			while($row = mysqli_fetch_array($result))
			{
				echo "<tr>";
				echo "<td>";
			    echo ($row['email']);
			    echo "</td>";

			    echo "<td>";
			    echo $row['gender'];
			    echo "</td>";

			    echo "<td>";
			    echo $row['city'];
			    echo "</td>";

			    echo "<td>";
			    echo "<img src=";
			    echo $row['profilepic'];
			    echo " width=\"50\">";
			    echo "</td>";

			    echo "<td>";
			    echo "<form action=\"delete.php\" method=\"post\">";
                echo "<input type=\"hidden\" name=\"email_id\" value=";
                echo $row['email'];
                echo">";
                echo "<input type=\"submit\"  name=\"deletebtn\" value=\"delete\">";
                echo "</form>";
			    echo "</td>";
			    echo "</tr>";
			}
			echo "</table>";
	    }
    ?>
</body>
</html>