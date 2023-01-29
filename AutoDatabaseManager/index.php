<?php
// line added to turn on color syntax highlight
require_once "pdo.php";
// echo "<pre>\n";
// $stmt = $pdo->query("SELECT * FROM users");
// $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r($rows);
// echo "</pre>\n";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nishant - Autos Database</title>
</head>

<body>
    <div class="container">
        <h1>Welcome to Autos Database</h1>
        <p>
            <a href="login.php">Please Log In</a>
        </p>
        <p>
            Attempt to go to
            <a href="view.php">view.php</a> without logging in - it should fail with an error message.
        </p>
        <p>
            Attempt to go to
            <a href="add.php">add.php</a> without logging in - it should fail with an error message.
        </p>
        <p>
            <a href="https://www.wa4e.com/assn/autosdb/" target="_blank">Specification for this Application</a>
        </p>
    </div>
</body>

</html>