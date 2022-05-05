<?php
    require "dbUtils.php";
    global $con;

    header("Access-Control-Allow-Origin: *");

    $sql = "SELECT * FROM Recipe";

    echo "<table border='1'><tr><th>RID</th><th>RecipeName</th><th>Type</th><th>Description</th><th>Author</th></tr>";

    $result = $con->query($sql);
    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['rid'] . "</td>";
            echo "<td>" . $row['recipeName'] . "</td>";
            echo "<td>" . $row['type'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . getAuthorByID($con, $row['uid']) . "</td>";
        }
    } else {
        echo "no recipes";
    }

    echo "</table";

    $con->close();

    function getAuthorByID($con,$id){
        $authorName = mysqli_query($con,"SELECT userName FROM User WHERE uid = $id");
        return mysqli_fetch_array($authorName)[0];
    }
?>
