<?php
    session_start();
    require "dbUtils.php";
    global $con;

    if(isset($_POST['add'])) {
        $recipeName = $_POST['recipeName'];
        $type = $_POST['type'];
        $description = $_POST['description'];
        $uid = $_SESSION['uid'];

        $sql = "INSERT INTO recipe(recipeName,`type`,description,uid) VALUES ('$recipeName','$type','$description','$uid')";

        $result = $con->query($sql);
        if($result == TRUE){
            echo "New record created successfully";
        }
        else{
            echo "Error: ".$sql."<br>".$con->error;
        }
        $con->close();
    }
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Add recipe</h2>
    <form action="" method="POST">
        <fieldset>
            <legend>Recipe information:</legend>
            Name:<br>
            <input type="text" name="recipeName">
            <br>
            Type:<br>
            <input type="text" name="type">
            <br>
            Description:<br>
            <input type="text" name="description">
            <br>

            <br><br>
            <input type="submit" name="add" value="add">
        </fieldset>
    </form>
    <button name="backButton" onclick="location.href='menu.php'">back</button>
</body>
</html>
