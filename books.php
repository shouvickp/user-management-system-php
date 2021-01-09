<?php
	if(isset($_POST['book_submit'])){
		require 'connect.php';
		$email = $_SESSION['email'];
		$books = array();
	    if(!empty($_POST['book'])) {

	        foreach($_POST['book'] as $value){
	            $books[]  = $value;
	        }
	        $all_book = join(", ",$books);

	        $query = "select * from book_habit where email = '$email'";
	        $result = mysqli_query($conn, $query);
	        if(mysqli_num_rows($result) == 0) {
	        	$query = "insert into book_habit (email, books) values ('$email', '$all_book')";
	        	$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
	        	echo "Your book habit inserted sucessfully.";
	        	echo "<br>"."Go to dashboard from <a href=\"welcome.php\"> here </a>";
	    	}
	    	else{
	    		$query = "update book_habit set books = '$all_book' where email = '$email'";
	    		$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
	        	echo "Your book habit updated sucessfully.";
	        	echo "<br>"."Go to dashboard from <a href=\"welcome.php\"> here </a>";
	    	}
	    }
	    else{
	    	echo "you have not select any books.";
	    	echo "<br>"."Go to dashboard from <a href=\"welcome.php\"> here </a>";
	    }

	}
?>