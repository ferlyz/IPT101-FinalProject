<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mystudents";

// Create connection with database
$connection = new mysqli($servername, $username, $password, $database);


$ID = "";
$FullName = "";
$Email = "";
$PhoneNumber = "";
$Address = "";

$errorMessage = "";
$correctMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
    // GET method: Show the data of the student

    if ( !isset($_GET["ID"]) ) {
        header("location: /mystudents/read.php");
        exit;
    }

    $ID = $_GET["ID"];

    // Read the row of selected client from databse table
    $sql = "SELECT * FROM students WHERE ID=$ID";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /mystudents/read.php");
        exit;
    }

    $FullName = $row["FullName"];
    $Email =  $row["Email"];
    $PhoneNumber = $row["PhoneNumber"];
    $Address = $row["Address"];
} 
else {
    // POST method: Update the data of the student

    $ID = $_POST["ID"];
    $FullName = $_POST["FullName"];
    $Email =  $_POST["Email"];
    $PhoneNumber = $_POST["PhoneNumber"];
    $Address = $_POST["Address"];

    do {
        if ( empty($ID) || empty($FullName) || empty($Email) || empty($PhoneNumber) || empty($Address) ) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE students " . 
               "SET FullName = '$FullName', Email = '$Email', PhoneNumber = '$PhoneNumber', Address = '$Address' " . 
               "WHERE ID = $ID";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $correctMessage = "Student updated successfully";

        header("location: /mystudents/read.php");
        exit;


    }while (false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Students</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script> src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"</script>
</head>
<body>
    <div class="container my-5">
        <h2>New Student</h2>

        <?php
        if( !empty($errorMessage) ) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        } 
        ?>

<form method="post">
   <input type="hidden" name="ID" value="<?php echo $ID; ?>">
   <div class="row mb-3">
       <label class="col-sm-3 col-form-label">FullName</label>
       <div class="col-sm-6">
           <input type="text" class="form-control" name="FullName" value="<?php echo $FullName; ?>">
       </div>        
   </div> 
   <div class="row mb-3">
       <label class="col-sm-3 col-form-label">Email</label>
       <div class="col-sm-6">
           <input type="text" class="form-control" name="Email" value="<?php echo $Email; ?>">
       </div>        
   </div> 
   <div class="row mb-3">
       <label class="col-sm-3 col-form-label">PhoneNumber</label>
       <div class="col-sm-6">
           <input type="text" class="form-control" name="PhoneNumber" value="<?php echo $PhoneNumber; ?>">
       </div>        
   </div>   
   <div class="row mb-3">
       <label class="col-sm-3 col-form-label">Address</label>
       <div class="col-sm-6">
           <input type="text" class="form-control" name="Address" value="<?php echo $Address; ?>">
       </div>        
   </div>  
   
   <?php
   if (!empty($correctMessage)) {
      echo "
      <div class='row mb-3'>
          <div class='offset-sm-3 col-sm-6'>
             <div class='alert alert-success alert-dismissible fade show' role='alert'>
                  <strong>$correctMessage</strong>
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
             </div>
          </div>
      </div>
      ";
   }
   ?>
    
   <div class="row mb-3">
       <div class="offset-sm-3 col-sm-3 d-grid">
           <button type="submit" class="btn btn-primary">Submit</button>
       </div>        
       <div class="col-sm-3 d-grid">
           <a  class="btn btn-outline-primary" href="/mystudents/read.php" role="button">Cancel</a>
       </div>
   </div>  
</form>
</div>    
</body>
</html>