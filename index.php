<?php 
    $server = "localhost";
    $username = "manager";
    $password = "123456";
    $db = "timetracker";

    $connection = mysqli_connect($server,$username,$password,$db);

    if(!$connection){
        die(mysqli_connect_error());
    }

    $sumQuery = "SELECT SUM(hoursWorked) FROM workCompleted";

    $sql2 = mysqli_query($connection, $sumQuery);
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

    <?php 
        $query = "SELECT date, hoursWorked, description, workCompleted.client, client.client FROM workCompleted INNER JOIN client ON workCompleted.client = client.id";

        $hourlyRate = 40;
        
        $sql = mysqli_query($connection,$query);

        while ($row=mysqli_fetch_array($sql2)){
            echo "<div class='stats-wrapper'>";
            echo "<div class='stat-box red'><p>Total Hours Worked: "."<span>".$row[0]."</span>"."</p></div>";
            echo "<div class='stat-box orange'><p>Total Amount Owed: "."<span>$".$row[0]* $hourlyRate."<span>"."</p></div>";
            echo "<div class='stat-box green'><a href='add.php'>Add new entry</a></div>";
            echo "</div>";
        }

        echo '<table>';
        echo '<thead>
                <tr>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Hours Worked</th>
                    <th>Description</th>
                </tr>
              </thead>';
        echo '<tbody>';

        while($row=mysqli_fetch_array($sql)){
            echo '<tr>';
            echo '<td>'.$row['date'].'</td>';
            echo '<td>'.$row['client'].'</td>';
            echo '<td>'.$row['hoursWorked'].'</td>';
            echo '<td>'.$row['description'].'</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    ?>
</body>
</html>