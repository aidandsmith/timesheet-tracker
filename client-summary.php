<?php  
    $server = "localhost";
    $username = "manager";
    $password = "123456";
    $db = "timetracker";

    $connection = mysqli_connect($server,$username,$password,$db);

    if(!$connection){
        die(mysqli_connect_error());
    }

    $hourlyRate = isset($_COOKIE['hourlyRate']) ? $_COOKIE['hourlyRate'] : 40;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Summary | Timesheet</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.php">View Entries</a>
        <a href="client-summary.php">Client Summary</a>
        <a href="add.php">Input Hours</a>
        <a href="enter-hourly-rate.php">Change Hourly Rate</a>
    </nav>
    <h1>Client Hours & Amount Owed</h1>
    <?php 
        $query = "SELECT client.id, client.client, SUM(workCompleted.hoursWorked) as totalHours FROM workCompleted INNER JOIN client ON workCompleted.client = client.id GROUP BY client.id, client.client ORDER BY totalHours DESC";
        
        $results = mysqli_query($connection, $query);

        if (!$results) {
            echo "<p>Error retrieving client summary</p>";
        } else {
            echo '<table>';
            echo '<thead>
                    <tr>
                        <th>Client</th>
                        <th>Total Hours</th>
                        <th>Amount Owed</th>
                    </tr>
                  </thead>';
            echo '<tbody>';
            
            $grandTotalHours = 0;
            $grandTotalOwed = 0;

            while($row = mysqli_fetch_array($results)) {
                $clientHours = $row['totalHours'];
                $amountOwed = $clientHours * $hourlyRate;
                
                echo '<tr>';
                echo '<td>'.$row['client'].'</td>';
                echo '<td>'.number_format($clientHours, 2).'</td>';
                echo '<td>$'.number_format($amountOwed, 2).'</td>';
                echo '</tr>';
                
                $grandTotalHours += $clientHours;
                $grandTotalOwed += $amountOwed;
            }

            echo '<tr style="font-weight: bold; background-color: #f2f2f2;">';
            echo '<td>TOTAL</td>';
            echo '<td>'.number_format($grandTotalHours, 2).'</td>';
            echo '<td>$'.number_format($grandTotalOwed, 2).'</td>';
            echo '</tr>';

            echo '</tbody>';
            echo '</table>';
        }
    ?>
</body>
</html> 