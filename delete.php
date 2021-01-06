<?php
    require ('connect.php');

    if(isset($_POST['deletebtn']))
    {
        $id = $_POST['email_id'];

        $query = "DELETE FROM user WHERE email='$id'";
        $result = mysqli_query($conn, $query);

        if($result)
        {
            header('Location: admin_panel.php'); 
        }
        else
        {
            echo "unable to delete data";
        }    
    }