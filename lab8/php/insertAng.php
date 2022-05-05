<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

session_start();
require "dbUtils.php";
global $con;

// receive json data as file and read it into a string
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata)) {
    // decode the json string
    $request = json_decode($postdata);

    $recipeName = mysqli_real_escape_string($con,trim($request->data->recipeName));
    $type = mysqli_real_escape_string($con,trim($request->data->type));
    $description = mysqli_real_escape_string($con,trim($request->data->description));
    $uid = 1; // $_SESSION['uid'];

    $sql = "INSERT INTO recipe(recipeName,`type`,description,uid) VALUES ('{$recipeName}','{$type}','{$description}','{$uid}')";

    if(mysqli_query($con,$sql)){
        http_response_code(201);
        $recipe = [
            'rid' => mysqli_insert_id($con),
            'recipeName' => $recipeName,
            'type' => $type,
            'description' => $description,
            'uid' => $uid
        ];
        echo json_encode(['data'=>$recipe]);
    }
    else{
        http_response_code(422);
    }
    $con->close();
}
?>