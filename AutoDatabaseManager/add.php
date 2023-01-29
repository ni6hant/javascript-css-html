<?php
require_once "pdo.php";
session_start();

if (!isset($_SESSION['name'])) {
    echo isset($_SESSION['name']);
    die('Not logged in');
}

if ( isset($_SESSION['error']) ) {
    echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
    unset($_SESSION['error']);
}

if ((isset($_POST['mileage'])) && (isset($_POST['year']))) {
    if (!(is_numeric($_POST['mileage']) && is_numeric($_POST['year']))) {
        //echo "Mileage and year must be numeric";
        $_SESSION['error'] = "Mileage and year must be numeric";
        header("Location: add.php");
        return;
    } else if (strlen($_POST['make']) < 1) {
        //echo "Make is required";
        $_SESSION['error'] = "Make is required";
        header("Location: add.php");
        return;
    } else {
        $stmt = $pdo->prepare('INSERT INTO autos
    (make, year, mileage) VALUES ( :mk, :yr, :mi)');
        $stmt->execute(
            array(
                ':mk' => $_POST['make'],
                ':yr' => $_POST['year'],
                ':mi' => $_POST['mileage']
            )
        );
        echo "Record inserted";
        $_SESSION['success'] = "Record inserted";
        header("Location: view.php");
        return;
    }
}

?>


<!DOCTYPE html>
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
    <form method="POST">
        <p>Make:
            <input type="text" name="make" size="60" />
        </p>
        <p>Year:
            <input type="text" name="year" />
        </p>
        <p>Mileage:
            <input type="text" name="mileage" />
        </p>
        <input type="submit" value="Add">
    </form>
    </ul>
</body>

</html>