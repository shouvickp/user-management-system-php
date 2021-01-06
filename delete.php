<?php
    require ('connect.php');

    //if delete button is pressed
    if(isset($_POST['deletebtn']))
    {
        //fetching the email of the user whose data is to be deleted
        $id = $_POST['email_id'];

        //making the query to delete the user
        $query = "DELETE FROM user WHERE email='$id'";
        //executing the query
        $result = mysqli_query($conn, $query);

        //if the query is sucessful then redirecting to the admin panel
        if($result)
        {
            header('Location: admin_panel.php'); 
        }
        //otherwise throwing an error message
        else
        {
            echo "unable to delete data";
        }    
    }