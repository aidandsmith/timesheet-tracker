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

    $hourlyRate = isset($_COOKIE['hourlyRate']) ? $_COOKIE['hourlyRate'] : 40;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Hours | Timesheet</title>
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
        $query = "SELECT date, hoursWorked, description, workCompleted.client, client.client FROM workCompleted INNER JOIN client ON workCompleted.client = client.id";
        
        $sql = mysqli_query($connection,$query);

        while ($row=mysqli_fetch_array($sql2)){
            echo "<div class='stats-wrapper'>";
            echo "<div class='stat-box red'><p>Total Hours Worked: "."<span>".$row[0]."</span>"."</p></div>";
            echo "<div class='stat-box orange'><p>Total Amount Owed: "."<span>$".$row[0]* $hourlyRate."<span>"."</p></div>";
            echo "<div class='stat-box green'><p>Current Hourly Rate: "."<span>$".$hourlyRate."</span></p></div>";
            echo "</div>";
        }

        echo '<table>';
        echo '<thead>
                <tr>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Hours Worked</th>
                    <th>Description</th>
                    <th>Cost for Work</th>
                </tr>
              </thead>';
        echo '<tbody>';

        while($row=mysqli_fetch_array($sql)){
            echo '<tr>';
            echo '<td>'.$row['date'].'</td>';
            echo '<td>'.$row['client'].'</td>';
            echo '<td>'.$row['hoursWorked'].'</td>';
            echo '<td>'.$row['description'].'</td>';
            echo '<td>$'.$row['hoursWorked']*$hourlyRate.'</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    ?>
</body>
</html>