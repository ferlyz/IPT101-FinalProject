<?php
if ( isset($_GET["ID"]) ) {
    $ID = $_GET["ID"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "mystudents";

    // Create connection with database
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM students WHERE ID=$ID";
    $connection->query($sql);
}

header("location: /mystudents/read.php");
exit;
?>