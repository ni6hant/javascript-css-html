<?php
require_once "pdo.php";
session_start();



if (isset($_SESSION['error'])) {
    echo ('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    echo ('<p style="color: green;">' . htmlentities($_SESSION['success']) . "</p>\n");
    unset($_SESSION['success']);
}


?>

<html>

<head>
    <title>Nishant's Basic CRUD Application</title>
</head>

<body>
    <h1>Welcome to the Automobiles Database</h1>

    <?php

    if (isset($_SESSION['error'])) {
        error_log("Index.PHP: Sesssion Error" . $_SESSION['error']);
        echo '<p style="color:red">' . $_SESSION['error'] . "</p>\n";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        error_log("Index.PHP: Sesssion Success" . $_SESSION['success']);
        echo '<p style="color:green">' . $_SESSION['success'] . "</p>\n";
        unset($_SESSION['success']);
    }

    if (isset($_SESSION['name'])) {
        error_log("Index.PHP: Session Name is set to " . $_SESSION['name']);
        echo ('<table border="1">' . "\n");
        $stmt = $pdo->query("SELECT make, model, year, mileage, auto_id FROM autos");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($rows)) {
            error_log("Index.PHP: No rows returned");
            echo ("No rows found");
        } else {
            error_log("Index.php: Printing Headers");
            echo ("<thead><tr>");
            echo ("<th>Make</th>");
            echo ("<th>Model</th>");
            echo ("<th>Year</th>");
            echo ("<th>Mileage</th>");
            echo ("<th>Action</th>");
            echo ("</tr></thead>");
        }

        //foreach (array as value)
        foreach ($rows as $row) {
            error_log("Printing row with auto_id" . $row['auto_id']);
            echo '<tr style="padding: 10px"><td style="padding: 10px">';
            echo (htmlentities($row['make']));
            echo('</td><td style="padding: 10px">');
            echo (htmlentities($row['model']));
            echo('</td><td style="padding: 10px">');
            echo (htmlentities($row['year']));
            echo('</td><td style="padding: 10px">');
            echo (htmlentities($row['mileage']));
            echo('</td><td style="padding: 10px">');
            echo ('<a href="edit.php?auto_id=' . $row['auto_id'] . '">Edit</a> / ');
            echo ('<a href="delete.php?auto_id=' . $row['auto_id'] . '">Delete</a>');
            echo ("</td></tr>\n");
        }
        error_log("All rows printed. Adding Add New Entry and Log out now");
        echo "</table>";
        echo '<p><a href="add.php">Add New Entry</a></p>';
        echo '<p><a href="logout.php">Logout</a></p>';
    } else {
        error_log('Session name not found');
        echo '<p><a href="login.php">Please log in</a></p>';
        echo 'Attempt to <a href="add.php">add data</a> without login';
    }

    ?>
</body>

</html>