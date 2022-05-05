<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

session_start();
require "dbUtils.php";
global $con;

$id = ($_GET['id'] !== null && (int)$_GET['id'] > 0)? mysqli_real_escape_string($con, (int)$_GET['id']) : false;

if(!$id) {
    return http_response_code(400);
}
//if($_GET['uid'] == $_SESSION['uid']){
$sql = "DELETE FROM recipe WHERE rid = {$id}";

if (mysqli_query($con, $sql)) {
    http_response_code(204);
} else {
    return http_response_code(422);
}
$con->close();
//}

?>