<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Hourly Rate | Timesheet</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.php">View Entries</a>
        <a href="client-summary.php">Client Summary</a>
        <a href="add.php">Input Hours</a>
        <a href="enter-hourly-rate.php">Change Hourly Rate</a>
    </nav>
    <h1>Set Your Hourly Rate</h1>
    <form action="hourly-rate-set.php" method="POST">
        <label for="hourlyRate">Hourly Rate ($):</label>
        <input placeholder="Enter Hourly Rate" type="number" id="hourlyRate" name="hourlyRate" step="1" min="1" required>
        <input type="submit" value="Set Rate">
    </form>
</body>
</html>
