<?php
    require 'dbUtils.php';
    global $con;

    $recipes = [];
    $sql = "SELECT * FROM Recipe";

    if($result = mysqli_query($con,$sql)){
        $count = 0;
        while($row = mysqli_fetch_assoc($result)){
            $recipes[$count]['rid'] = $row['rid'];
            $recipes[$count]['recipeName'] = $row['recipeName'];
            $recipes[$count]['type'] = $row['type'];
            $recipes[$count]['description'] = $row['description'];
            $recipes[$count]['uid'] = $row['uid'];
            $count++;
        }
        echo json_encode(['data'=>$recipes]);
    }
    else{
        http_response_code(404);
    }
?>