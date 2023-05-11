<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mystudents";

// Create connection with database
$connection = new mysqli($servername, $username, $password, $database);


$FullName = "";
$Email = "";
$PhoneNumber = "";
$Address = "";

$errorMessage = "";
$correctMessage = "";


if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $Name = $_POST["FullName"];
    $email =  $_POST["Email"];
    $Phone = $_POST["PhoneNumber"];
    $address = $_POST["Address"];

    do {
       if ( empty($FullName) || empty($Email) || empty($PhoneNumber) || empty($Address) ) {
           $errorMessage = "All the fields are required";
           break;
       }
       // Add new student to database
       $sql = "INSERT INTO students (FullName, Email, PhoneNumber, Address) ".
              "VALUES ('$FullName, '$Email', '$PhoneNumber', '$Address')";
       $result = $connection->query($sql);
       
       if(!$result) {
         $errorMessage = "Invalid query: " . $connection->error;
         break;
       }

       $FullName = "";
       $Email = "";
       $PhoneNumber = "";
       $Address = "";

       $correctMessage = "Student added successfully";

       header("location: ead.php");
       exit;

    } while (false);
}
?>