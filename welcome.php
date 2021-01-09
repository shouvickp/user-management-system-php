<?php
	require "./connect.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

	<style>
		body{
			padding:5px;
		}
	.card-horizontal {
	    display: flex;
	    flex: 1 1 auto;
	}
	.card-body{
		margin-left: 2%;
	}
	</style> 
</head>
<body>
	<nav class="navbar navbar-light bg-light">
	  <button onclick="logout()"class="btn btn-warning my-2 my-sm-0" type="submit">logout</button>
	</nav>
	<div class="container">
		<?php
			$email=$_SESSION["email"];
			//query to show user details
			$query="select * from user where email='$email'";
			//executing the query
			$query_result = mysqli_query($conn, $query);
			//if found
			if ($query_result->num_rows > 0) {
			  $row = $query_result->fetch_assoc();
			}
			//displaying details of user in bootstrap card next
		?>
		<div class="row row-content">
			<div class="col-12">
				<h2> welcome to Techmonastic</h2><hr>
			</div>
            <div class="card">
                <div class="card-horizontal">
                    <div style="padding: 10px;" class="img-square-wrapper">
                        <img class="img-fluid" id="profilepic" src="<?php echo $row["profilepic"]?>" alt="Card image cap" alt="Profile Image" width="150">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title"><b>Hi, <?php echo $row["email"]?></h3>
                        <p class="card-text"><b>Your credentials: </b><br>
						<b><?php echo "Gender: ".$row["gender"]?></b><br>
						<b><?php echo "City: ".$row["city"]?></b><br>
						<?php
							$query = "select * from book_habit where email = '$email'";
	        				$result = mysqli_query($conn, $query);
	        				if ($result->num_rows > 0) {
							  $row = $result->fetch_assoc();
							  echo "<b> Book Habit: ".$row['books']."</b><br>";
							  echo "<b> Favourite Books: ".$row['favourite']."</b><br>";
							}
							else{
								echo "<b> Book Habit: </b><br>";
								echo "<b> Favourite Books: </b><br>";
							}	
						?>
                    </div>
                </div>
            </div>
        </div>		
	</div>
	<div class="container">
		<br>
		<form enctype="multipart/form-data">
			<div class="form-group">
				<label for="imageFile"><b>Select image to update profile photo:</b>
		    	<input type="file" name="imageFile" id="imageFile" accept="image/*" onchange="readURL(this);">
		    	</label>
		    </div>
		    <div class="form-group">
	            <button type="submit" id="image-upload" onclick="upd_img()" name="image-upload" class="btn btn-primary btn-block-sm"> Upload image </button>
	        </div>
    	</form>
	</div>
	<div class="container">
		<br>
		<form>
			<div class="form-group">
				<label for="city"><b>update your city: </b></label>
		        	<select name="city" id="city">
		            <option value="Kolkata">Kolkata</option>
		            <option value="Howrah">Howrah</option>
		            <option value="Chennai">Chennai</option>
		            <option value="Mumbai">Mumbai</option>
		            <option value="Delhi">Delhi</option>
		          </select>&nbsp; &nbsp;
		    	<button type="submit" onclick="upd_city()" name="submit">Update</button>
		    </div>
    	</form>
	</div>
	<br><br>
	<div class="container panel-margin">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">Change Password</h2>
			</div>
			<div class="panel-body">
				<form action="password_script.php" method="post">
					<div class="form-group">
						<input type="password" class="form-control" name="old_pass" placeholder="Old Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[!@#$%^&*~])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter and one special characters, and at least 8 or more characters" required>
						</div>
					<div class="form-group">
						<input type="password" class="form-control" name="new_pass" placeholder="New Password" id="new_pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[!@#$%^&*~])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter and one special characters, and at least 8 or more characters" required>
					</div>
					<div class="form-group">
						<input type="password" class="form-control" name="retype_new_pass" id="retype_new_pass" placeholder="Re-type New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[!@#$%^&*~])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter and one special characters, and at least 8 or more characters" required>
					</div>
					<button type="submit" onclick="change_pass()" class="btn btn-primary">Change</button>
				</form>
			</div>
		</div>
	</div>
	<br><br>
	<div class="container">
		<table>
			<tr>
				<td>
					<form method="post" action="books.php">
						<span>Select Books</span><br>
						<input type="checkbox" name='book[]' value="PHP: A Beginner’s Guide"> PHP: A Beginner’s Guide <br>
						<input type="checkbox" name='book[]' value="Learn JavaScript VISUALLY"> Learn JavaScript VISUALLY <br>
						<input type="checkbox" name='book[]' value="JavaScript & JQuery: Interactive Front-End Web Development"> JavaScript & JQuery: Interactive Front-End Web Development <br>
						<input type="checkbox" name='book[]' value="Angular — The Complete Guide"> Angular — The Complete Guide<br><br>
						<input type="submit" name="book_submit" value="submit">
					</form>
				</td>
				<td style="padding-left: 30px;">
					<?php
					//fetching books from database
						$query = "SELECT name FROM book_db ORDER BY name ASC";
						$result = $conn->query($query);
					?>
					<div class="form-group">
			            <label>Select Favourite Book</label>
			            <!-- <select name="fav_book" id="fav_book" class="form-control form-control-lg select2"> -->
			            <select class="selectpicker" onclick="select_book()" multiple data-live-search="true">
				            <?php
					            foreach($result as $row)
					            {
					              echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
					            }
				            ?>
				        </select>
				        <br>
				        <button onclick="upd_fav_book()"class="btn btn-primary my-2 my-sm-0" type="submit">Update</button>
			        </div>
				</td>
			</tr>
		</table>	
	</div>

	<script>
        //function to preview the image
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profilepic')
                        .attr('src', e.target.result)
                        .width(150);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        // function to logout
        function logout() {
        	$.ajax({
		        url: 'logout.php',
	            type: 'get',
	            data:{action:'logout'},
	            success: function(data){
	            	alert(data);
	                window.location.href = "login.html";
	            }
		      });
        }
        function select_book(){
		  $('select').selectpicker();
		}
		function upd_fav_book(){
			var selected = $('.selectpicker').val();
			var form_data = 'fav_book='+selected;
    		$.ajax({
		        url: "fav_book.php",                 //Server api to receive the file
		        type: "POST",
		        data: form_data,
		        success:function(data){
		            if(data!=0) {
		                alert(data);
		                location.reload();
		            }
		            else 
		            	alert("You have not selected any books");
		        }
		      });
		}
		function upd_img(){
			var file_data = $('#imageFile').prop('files')[0];    //Fetch the file
		    var form_data = new FormData();
		    form_data.append("imageFile",file_data);
		    if(file_data){
		    	$.ajax({
	        		url: "update-image.php",                   //Server api to receive the file
	            	type: "POST",
	            	dataType: 'script',
	            	cache: false,
	            	contentType: false,
	            	processData: false,
	            	data: form_data,
	           		success:function(html){
	              			              	
	              	}
      			});
		    }
		    else{
		    	alert('No image selected.');
		    }
		    
		}

		function upd_city(){
			var city = $('#city').val();
			var form_data = "city="+city;
			$.ajax({
	        		url: "update-city.php",         //Server api to receive the file
	            	type: "POST",
	            	data: form_data,
	           		success:function(html){
	              		if(html != 0) {
	              			alert(html);
	              			location.reload();
	              		}
	              		else{
	              			alert('Some error occur! Please try again later.');
	              		}
	              	}
      			});
		}

    </script>
</body>
</html>