<?php

    header("Access-Control-Allow-Origin: *");

    // connect to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dblab7";

    global $currentUserID;

    // create connection
    $con = new mysqli($servername,$username,$password,$dbname);

    // check connection
    if(!$con){
        die("Connection failed: " . mysqli_connect_error());
    }
    else{
        //echo "Connection successful!";
    }

?>