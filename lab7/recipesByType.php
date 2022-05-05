<?php

    require "dbUtils.php";
    global $con;

    $type = $_GET['type'];
    $result = mysqli_query($con, "SELECT * FROM recipe WHERE type='$type'");

    $jsonData = array();
    $jsonRecord = array();
    $index = 0;
    while($row = mysqli_fetch_array($result)){
        $jsonRecord['rid'] = $row['rid'];
        $jsonRecord['recipeName'] = $row['recipeName'];
        $jsonRecord['type'] = $row['type'];
        $jsonRecord['description'] = $row['description'];
        $jsonRecord['uid'] = $row['uid'];
        $id = $row['uid'];
        $jsonRecord['userName'] = getAuthorByID($con,$id);
        $jsonData[$index] = $jsonRecord;
        $index += 1;
    }

    echo json_encode($jsonData);
    mysqli_close($con);

    function getAuthorByID($con,$id){
        $authorName = mysqli_query($con,"SELECT userName FROM User WHERE uid = $id");
        return mysqli_fetch_array($authorName)[0];
    }

?>