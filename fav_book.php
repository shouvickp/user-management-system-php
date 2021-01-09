<?php


    if(isset($_POST['fav_book'])){
      require "connect.php";
      $fav_books = $_POST['fav_book'];
      $email = $_SESSION['email'];
      $query = "select * from book_habit where email = '$email'";
      $result = mysqli_query($conn, $query);
      if(mysqli_num_rows($result) == 0) {
            $query = "insert into book_habit (email,favourite) values ('$email', '$fav_books')";
            $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
            echo "Your favourite books  inserted sucessfully.";
      }
      else{
          $query = "update book_habit set favourite = '$fav_books' where email = '$email'";
          $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
            echo "Your favourite books updated sucessfully.";
      }
    }
    else{
      echo 0;
    }
?>