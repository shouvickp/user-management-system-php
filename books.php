<?php
		require 'connect.php';
		$email = $_SESSION['email'];
	    if(!empty($_POST['all_book'])) {

	        $all_book =	 $_POST['all_book'];

	        $query = "select * from book_habit where email = '$email'";
	        $result = mysqli_query($conn, $query);
	        if(mysqli_num_rows($result) == 0) {
	        	$query = "insert into book_habit (email, books) values ('$email', '$all_book')";
	        	$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
	        	echo "Your book habit inserted sucessfully.";
	    	}
	    	else{
	    		$query = "update book_habit set books = '$all_book' where email = '$email'";
	    		$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
	        	echo "Your book habit updated sucessfully.";
	    	}
	    }
	    else{
	    	echo "you have not select any books.";
	    }