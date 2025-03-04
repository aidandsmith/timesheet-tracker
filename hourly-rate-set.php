<?php
    if (isset($_POST['hourlyRate'])) {
        $rate = $_POST['hourlyRate'];
        
        setcookie("hourlyRate", $rate, strtotime('30 days'), "/");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Rate | Timesheet</title>
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
        echo '<h1>The hourly rate was set to '.$rate.'</h1>';
    ?>
</body>
</html>