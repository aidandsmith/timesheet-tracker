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
    <title>Adding Entry... | Timesheet</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.php">View Entries</a>
        <a href="client-summary.php">Client Summary</a>
        <a href="add.php">Input Hours</a>
        <a href="enter-hourly-rate.php">Change Hourly Rate</a>
    </nav>
    <?php
        $date = mysqli_real_escape_string($connection, $_POST['date']);
        $client = mysqli_real_escape_string($connection, $_POST['client']);
        $hoursworked = mysqli_real_escape_string($connection, $_POST['hoursworked']);
        $description = mysqli_real_escape_string($connection, $_POST['desc']);

        $query = "INSERT INTO workCompleted (date, client, hoursworked, description) VALUES ('$date', '$client', '$hoursworked', '$description')";

        $sql = mysqli_query($connection,$query);

        if($sql){
            echo "<h1>Your hours have sucessfully been added to the time sheet.</h1>";
        }else{
            echo "<h1>Your hours were not sucessfully added. Please try again.</h1>";
            echo mysqli_error($connection);
        }
    ?>
</body>
</html>