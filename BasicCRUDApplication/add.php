<?php
session_start();
require_once "pdo.php";

if (!isset($_SESSION['name'])) {
    error_log("In Add.PHP: Session Name not defined hence die");
    die('Not logged in');
}

if (isset($_SESSION['success'])) {
    error_log("In Add.php: Session Success is set to ".$_SESSION['success']);
    echo ('<p style="color: green;">' . htmlentities($_SESSION['success']) . "</p>\n");
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    error_log("In Add.php: Session Error is set to ".$_SESSION['error']);
    echo ('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
    unset($_SESSION['error']);
}
if (isset($_POST['logout'])) {
    error_log("In Add.php: Logout has been pressed ".$_POST['logout']);
    header('Location: logout.php');
    return;
}

if (isset($_POST['add'])) {
    error_log("In Add.PHP: Add button has been posted with the value of ".$_POST['add']." ");
}

// if ((empty($_POST['make']) && empty($_POST['model']) && (empty($_POST['model'])) && (empty($_POST['model'])))) {
//     error_log("In Add.PHP: All fiels are not filled, redirecting to same page");
//     $_SESSION['error'] = "All values are required";
//     header("Location: add.php");
//     return;
//  }


if ((isset($_POST['mileage'])) && (isset($_POST['year']))) {
    error_log("In Add.PHP: mileage and year has been entered");
    if (empty($_POST['model']) && empty($_POST['make'])) {
        error_log("In Add.PHP: model and make are empty hence All field are required and redirecting to the same page");
        $_SESSION['error'] = "All fields are required";
        header("Location: add.php");
        return;
    }

    if (!(is_numeric($_POST['mileage']) && is_numeric($_POST['year']))) {
        error_log("In Add.PHP: Mileage and year must be numeric");
        $_SESSION['error'] = "Mileage and year must be numeric";
         header("Location: add.php");
         return;
    } else if (strlen($_POST['make']) < 1) {
        error_log("In Add.PHP: Make is required");
        $_SESSION['error'] = "Make is required";
        header("Location: add.php");
        return;
    } else if (strlen($_POST['model']) < 1) {
        error_log("In Add.PHP: Model is requiered");
        $_SESSION['error'] = "Model is requiered";
        header("Location: add.php");
        return;
    } else {
        error_log("In Add.PHP: All values are entered proceeding to input value in database");
        $stmt = $pdo->prepare('INSERT INTO autos
    (make, model, year, mileage) VALUES ( :mk, :md, :yr, :mi)');
        $stmt->execute(
            array(
                ':mk' => $_POST['make'],
                ':md' => $_POST['model'],
                ':yr' => $_POST['year'],
                ':mi' => $_POST['mileage'],
            )
        );
        error_log("In Add.PHP: All values entered and added in the database with the SQL Query");
        $_SESSION['success'] = "Added";
        header("Location: index.php");
        return;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nishant's Basic CRUD Application</title>
</head>

<body>
    <div class="container">
        <h1>Tracking Autos for
            <?php
            error_log("In Add.PHP: with $_SESSION[name] value of ".$_SESSION['name']);
            echo $_SESSION['name'];
            ?>
        </h1>
        <form method="post">
            <p>Make:
                <input type="text" name="make" size="60">
            </p>
            <p>Model:
                <input type="text" name="model" size="60">
            </p>
            <p>Year:
                <input type="text" name="year">
            </p>
            <p>Mileage:
                <input type="text" name="mileage">
            </p>
            <input type="submit" name="add" value="Add">
            <input type="submit" name="logout" value="Logout">
        </form>

        <h2>Automobiles</h2>
        <?php
        error_log("In Add.PHP: Trying to run the query to populate the table");
        $stmt2 = $pdo->query("SELECT make, model, year, mileage FROM autos");
        $rows = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        if ($rows === false) {
            error_log("Add.PHP: No rows returned" . $rows);
            $_SESSION['error'] = "No rows found";
            header("Location: index.php");
            return;
        }
        foreach ($rows as $row) {
            echo "<ul><li>";
            echo htmlentities($row['make']);
            echo " ";
            echo htmlentities($row['model']);
            echo " ";
            echo htmlentities($row['year']);
            echo " ";
            echo htmlentities($row['mileage']);
            echo " / 100";
            echo "</li></ul>\n";
        }
        error_log("In Add.PHP: Table printing complete");
        ?>
    </div>
</body>

</html>