<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

session_start();
require "dbUtils.php";
global $con;

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
    // Extract the data.
    $request = json_decode($postdata);

    // Validate.
    if ((int)$request->data->rid < 1) {
        return http_response_code(400);
    }

    $rid = mysqli_real_escape_string($con, (int)$request->data->rid);
    $recipeName = mysqli_real_escape_string($con,trim($request->data->recipeName));
    $type = mysqli_real_escape_string($con,trim($request->data->type));
    $description = mysqli_real_escape_string($con,trim($request->data->description));
    $uid = 1; // $_SESSION['uid'];

    // Update.
    $sql = "UPDATE `recipe` SET `recipeName`='$recipeName',`type`='$type',`description`='$description', `uid`='{$uid}' WHERE `rid` = '{$rid}'";


    if(mysqli_query($con, $sql))
    {
        http_response_code(204);
    }
    else
    {
        return http_response_code(422);
    }

}
?>