<?php 
    $server = "localhost";
    $username = "manager";
    $password = "123456";
    $db = "timetracker";

    $connection = mysqli_connect($server,$username,$password,$db);

    if(!$connection){
        die(mysqli_connect_error());
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $date = mysqli_real_escape_string($connection, $_POST['date']);
        $client = mysqli_real_escape_string($connection, $_POST['client']);
        $hoursworked = mysqli_real_escape_string($connection, $_POST['hoursworked']);
        $description = mysqli_real_escape_string($connection, $_POST['desc']);

        $query = "INSERT INTO workCompleted (date, client, hoursworked, description) VALUES ('$date', '$client', '$hoursworked', '$description')";

        $sql = mysqli_query($connection,$query);

        if($sql){
            echo "<p>Your hours have sucessfully been added to the time sheet.</p>";
        }else{
            echo "<p>Your hours were not sucessfully added. Please try again.</p>";
            echo mysqli_error($connection);
        }
    ?>
</body>
</html>