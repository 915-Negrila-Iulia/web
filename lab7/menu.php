<html>
<head>
    <script src="../../jquery-3.6.0.min.js"></script>
</head>

<body>

<?php
    session_start();

    if(isset($_POST['logout'])) {
        header("Location: logIn.php");
    }

    require "dbUtils.php";
    global $con;

    $sql = "SELECT * FROM Recipe";

    echo "<table id='recordsTable' border='1'><tr><th>RID</th><th>RecipeName</th><th>Type</th><th>Description</th><th>Author</th><th colspan='2'>Actions</th></tr>";

    $result = $con->query($sql);
    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr onclick='setTextBoxId(this)'>";
            echo "<td>" . $row['rid'] . "</td>";
            echo "<td>" . $row['recipeName'] . "</td>";
            echo "<td>" . $row['type'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . getAuthorByID($con, $row['uid']) . "</td>";
            echo "<td><button name='updateButton' onclick=location.href='update.php?update=$row[rid]&uid=$row[uid]'>update</button></td>";
            echo "<td><button name='deleteButton' onclick=location.href='delete.php?delete=$row[rid]&uid=$row[uid]'>delete</button></td>";
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
    <br><br>
<!--    <script  type="text/javascript">-->
<!--        function setTextBoxId(e){-->
<!--            console.log(e.innerText[0]);-->
<!--        }-->
<!--    </script>-->

    <div>
        <button name="insertButton" onclick="location.href='insert.php'">add</button>
        <button name="filterButton" onclick="lastSearch();run()">filter</button>
        <input type="text" id="filterText">
        <label id="lastFilter"></label>
    </div>

    <br>
    <form action="" method="POST">
        <button name="logout">Logout</button>
    </form>

    <script language="javascript">
        var lastFilter = "no filter";
        function show(json){
            //The :gt() selector selects elements with an index number higher than a specified number
            //delete all rows (<tr>) from table except first one (the header)
            $("#recordsTable").find("tr:gt(0)").remove();
            console.log($('#recordsTable tr').length);
            let i=0;
            while(i < json.length){
                var currentUid = json[i].uid;
                //document.write(json[i].rid+" "+json[i].recipeName+" "+json[i].type+" "+json[i].description+" "+json[i].uid);
                $('<tr>').html("<td>" + json[i].rid + "</td><td>" + json[i].recipeName + "</td><td>" + json[i].type + "</td><td>"
                                + json[i].description + "</td><td>" + json[i].userName + "</td>" +
                    "<td><button name='updateButton' onclick=location.href='update.php?update="+json[i].rid+"&uid="+json[i].uid+"'>update</button></td>" +
                    "<td><button name='deleteButton' onclick=location.href='delete.php?delete="+json[i].rid+"&uid="+json[i].uid+"'>delete</button></td>"
                ).appendTo('#recordsTable');
                $("#recordsTable>tbody").append();
                i = i+1;
            }
        }
        // $(document).ready(function run(){
        function run(){
            //console.log($('#recordsTable tr').length);
            var filterText = $('#filterText').val();
            lastFilter = filterText;
                $.getJSON(
                "recipesByType.php",
                {type: filterText},
                show
            );
        }
        function lastSearch(){
            //console.log($("#lastFilter").text());
            $("#lastFilter").text(lastFilter);
        }
        // window.onload=run;
    </script>

</body>
</html>
