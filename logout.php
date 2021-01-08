<?php
	require "connect.php";
	if(isset($_GET['action'])  && $_GET['action'] == "logout" ) {
    session_destroy();
    session_unset();  
    echo "logout";
    exit;
	}
