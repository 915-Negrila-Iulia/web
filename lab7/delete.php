<?php
    session_start();
    require "dbUtils.php";
    global $con;

    if(isset($_GET['delete']) && isset($_GET['uid'])) {
        if($_GET['uid'] == $_SESSION['uid']){
            $rid = $_GET['delete'];
            $sql = "DELETE FROM recipe WHERE rid = $rid";
            $result = $con->query($sql);
            if($result == TRUE){
                echo "Record removed successfully";
            }
            else{
                echo "Error: ".$sql."<br>".$con->error;
            }
        }
        else{
            echo ":(\n";
            echo "Recipes can be deleted only by their author";
        }
        $con->close();
    }
?>