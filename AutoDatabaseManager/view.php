<?php
require_once "pdo.php";
session_start();

if (!isset($_SESSION['name'])) {
    die('Not logged in');
}

if ( isset($_SESSION['error']) ) {
    echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
    unset($_SESSION['error']);
}

if ( isset($_SESSION['success']) ) {
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
}

?>

<html>

<head>
    <title>Nishant's Automobile Tracker</title>
</head>

<body>
    <h1>Tracking Autos for
        <?php
        echo $_SESSION['name'];
        ?>
    </h1>
    <h2>Automobiles</h2>

    <?php
        $stmt2 = $pdo->query("SELECT year, make, mileage FROM autos");
        $rows = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            echo "<ul><li>";
            echo htmlentities($row['year']);
            echo " ";
            echo htmlentities($row['make']);
            echo " / ";
            echo htmlentities($row['mileage']);
            echo "</li></ul>\n";
        }
        ?>
        <a href="add.php">Add New</a>
        <span> | </span>
        <a href="logout.php">Logout</a>
</body>

</html>