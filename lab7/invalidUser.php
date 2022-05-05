<?php

    if(isset($_POST['backButton'])) {
        header("Location: logIn.php");
    }
?>

<html>
<body>
    <h2>Invalid user</h2>
    <form action="" method="POST">
        <button name="backButton">Back</button>
    </form>
</body>
</html>