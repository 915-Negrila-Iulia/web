<!DOCTYPE html>
<html>
<body>

<?php
    session_start();
    require "dbUtils.php";
    global $con;

    if(isset($_GET['update']) && isset($_GET['uid'])) {
        if ($_GET['uid'] == $_SESSION['uid']) {

            if(isset($_POST['updateButton'])){
                $rid = $_GET['update'];
                $recipeName = $_POST['recipeName'];
                $type = $_POST['type'];
                $description = $_POST['description'];

                $sql = "UPDATE recipe SET recipeName='$recipeName', `type`='$type', description='$description' WHERE rid='$rid';";
                $result = $con->query($sql);
                if($result == TRUE){
                    echo "Record updated successfully";
                }
                else{
                    echo "Error: ".$sql."<br>".$con->error;
                }
            }

            ?>

<h2>Update recipe</h2>
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
        <input type="submit" name="updateButton" value="update">
    </fieldset>
</form>
<button name="backButton" onclick="location.href='menu.php'">back</button>

<?php
        }
        else{
            echo ":(\n";
            echo "Recipes can be updated only by their author";
        }
    }
?>

</body>
</html>
