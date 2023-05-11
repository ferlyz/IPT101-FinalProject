<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Students</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">

    <style>
        *{
            background-color:black;
            color:white;
        }

        body{
            background-color:black;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <h2>Qualified International Soccer Students</h2>
        <a class="btn btn-success" href="/mystudents/create.php" role="button">New Student</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "mystudents";

                // Create connection with database
                $connection = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                // Read all row from database table
                $sql = "SELECT * FROM students";
                $result = $connection->query($sql);

                if(!$result) {
                    die("Invalid query: " . $connection->error);
                }

                // Read data of each row
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$row[ID]</td>
                        <td>$row[FullName]</td>
                        <td>$row[Email]</td>
                        <td>$row[PhoneNumber]</td>
                        <td>$row[Address]</td>
                        <td>$row[created_at]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/mystudents/update.php?ID=$row[ID]'>Update</a>
                            <a class='btn btn-danger btn-sm' href='/mystudents/delete.php?ID=$row[ID]'>Delete</a>
                            <a class='btn btn-warning btn-sm' href='/mystudents/placesapi.php?ID=$row[ID]'>BMI Calculator</a>
                            <a class='btn btn-info btn-sm' href='/mystudents/translateapi.php?ID=$row[ID]'>Translator</a>
                    </tr>
                    ";
                }
                ?>
                
            </tbody>
        </table>

    </div>        
</body>
</html>