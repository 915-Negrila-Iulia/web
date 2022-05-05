<?php

    header("Access-Control-Allow-Origin: *");

    require "dbUtils.php";
    global $con;

    if(isset($_POST['submit'])){
        $userName = $_POST['userName'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM `user` WHERE userName = '$userName' and email = '$email' and password = '$password'";
        $result = $con->query($sql);
        //echo "Nr users: ".$result->num_rows;

        if($result->num_rows == 1){
            session_start();
            $user = $result->fetch_assoc();
            $_SESSION['uid'] = $user['uid'];
            echo $_SESSION['uid'];
            header("Location: menu.php");
        }
        else{
            header("Location: invalidUser.php");
        }

    }
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Log in</h2>
    <form action="" method="POST">
        <fieldset>
            Name:<br>
            <input type="text" name="userName">
            <br>
            Email:<br>
            <input type="email" name="email">
            <br>
            Password:<br>
            <input type="password" name="password">
            <br>

            <br><br>
            <input type="submit" name="submit" value="login">
        </fieldset>
    </form>
</body>
</html>