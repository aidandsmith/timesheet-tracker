<?php 
    $server = "localhost";
    $username = "manager";
    $password = "123456";
    $db = "timetracker";

    $connection = mysqli_connect($server,$username,$password,$db);

    if(!$connection){
        die(mysqli_connect_error());
    }

    $query = "SELECT * FROM client";

    $results = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="add.php">Input Hours</a>
        <a href="#">Change Hourly Rate</a>
        <a href="index.php">View Timesheet</a>
    </nav>
   <h1>Add work</h1>
   <form action="insert-entry.php" method="POST">
        <label for="date">Date</label>
        <input required type="date" name="date" id="date">
        <label for="client">Client</label>
        <select required name="client" id="client">
        <?php
            while ($row = mysqli_fetch_array($results)) {
                echo "<option value='" . $row['id'] . "'>" . $row['client'] . "</option>";
            }
        ?>
        </select>
        <label for="hoursworked">Hours Worked</label>
        <input required step="0.15" name="hoursworked" id="hoursworked" type="number">
        <label for="desc">Description</label>
        <textarea type="text" name="desc" id="desc"></textarea>
        <input type="submit" value="Submit Hours">
   </form> 
</body>
</html>