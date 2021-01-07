<html>
  <head>
    <title>Forgot Password</title>
    <style type="text/css">
     input{
     border: 1px solid olive;
     border-radius: 5px;
     height: 30px;
     }
     h1{
      color: darkgreen;
      font-size: 22px;
      text-align: center;
     }
     #submit{
      background-color: darkgreen;
      color: white;
     }
    </style>
  </head>
  <body>
    <h1>Forgot Password<h1>
    <form action='#' method='post'>
      <table cellspacing='5' align='center'>
      <tr>
        <td><b>Email id:</b></td>
        <td><input type='text' name='email'/></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type='submit' id="submit" name='submit' value='Send temporary password in Email'/></td>
      </tr>
      </table>
    </form>
      <?php

        function randomPassword() {
            $alphabet = "@~#$%^&*()abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
            $pass = array(); //declaring $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 
            for ($i = 0; $i < 16; $i++) {
                $n = rand(0, $alphaLength);
                $pass[$i] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string;
        }

        require "./connect.php";

        if(isset($_POST['submit']))
        { 
           $email = $_POST['email'];
           $query = "select * from user where email='$email'";
           $result = mysqli_query($conn, $query);
           if(mysqli_num_rows($result) != 0)  
           {
              $row = mysqli_fetch_array($result);
              $temp_pass = randomPassword();
              $hashed_pass = md5($temp_pass);
              $update_query = "UPDATE user SET password = '$hashed_pass' WHERE email = '$email'";
              $res = mysqli_query($conn, $update_query) or die(mysqli_error($conn));

              $to = $email;
              $subject = 'Remind password';
              $message = 'This is your temporary password : '.$temp_pass.' . Please reset it after login.  http://localhost/Office/assign1/login.html'; 
              $headers = 'From: shouvickp@gmail.com';
              $m=mail($to,$subject,$message,$headers);
              if($m)
              {
                echo 'Check your inbox in mail your temporary password is sent.';
              }
              else
              {
                echo 'Sorry! mail is not send';
              }
           }
           else
           {
            echo 'You entered mail id is not present in the database';
           }
        }
      ?>
  </body>
</html>