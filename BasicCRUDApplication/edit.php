<?php
require_once "pdo.php";
session_start();

if (isset($_SESSION['success'])) {
    error_log("In Edit.php: Session is to success with value " . $_SESSION['success']);
    echo ('<p style="color: green;">' . htmlentities($_SESSION['success']) . "</p>\n");
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    error_log("In Edit.php: Session is set to error with value ".$_SESSION['error']);
    echo ('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
    unset($_SESSION['error']);
}

if (isset($_POST['mileage']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['make']) && isset($_POST['auto_id'])) {
    //TODO Is the above condition check necessary at all, since we are checking everything one by one down below
    //Can't just addding isset autoID post be enough?

    //Data validation should go here
    if ((isset($_POST['mileage'])) && (isset($_POST['year']))) {
        error_log("In Edit.PHP: mileage and year has been entered");
        if (empty($_POST['model']) && empty($_POST['make'])) {
            error_log("In Edit.PHP: model and make are empty hence All field are required and redirecting to the same page");
            $_SESSION['error'] = "All fields are required";
            header("Location: edit.php");
            return;
        }

        if (!(is_numeric($_POST['mileage']) && is_numeric($_POST['year']))) {
            error_log("In Edit.PHP: Mileage and year must be numeric");
            $_SESSION['error'] = "Mileage and year must be numeric";
            header("Location: edit.php");
            return;
        } else if (strlen($_POST['make']) < 1) {
            error_log("In Edit.PHP: Make is required");
            $_SESSION['error'] = "Make is required";
            header("Location: edit.php");
            return;
        } else if (strlen($_POST['model']) < 1) {
            error_log("In Edit.PHP: Model is required");
            $_SESSION['error'] = "Model is required";
            header("Location: edit.php");
            return;
        } else {
            error_log("In Edit.PHP: All values are entered proceeding to update value in database");

            //TODO: Clean once test is complete
            // error_log("In Edit.php: ");
            //  if (!(is_numeric($_POST['mileage']) && is_numeric($_POST['year']))) {
            //     error_log("In Edit.php: ");
            //     $_SESSION['error'] = "Mileage and year must be numeric";
            //      header("Location: edit.php?auto_id=".$_GET['auto_id']);
            //      return;
            // }

            // if (strlen($_POST['make']) < 1) {
            //     error_log("In Edit.php: ");
            //     $_SESSION['error'] = "Make is required";
            //     header("Location: edit.php?auto_id=".$_GET['auto_id']);
            //     return;
            // }

            // if (strlen($_POST['model']) < 1) {
            //     error_log("In Edit.php: ");
            //     $_SESSION['error'] = "Model is required";
            //     header("Location: edit.php?auto_id=".$_GET['auto_id']);
            //     return;
            // } 

            $sql = "UPDATE autos SET make = :make, model =:model, year = :year, mileage = :mileage WHERE auto_id = :auto_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(
                array(
                    ':make' => $_POST['make'],
                    ':model' => $_POST['model'],
                    ':year' => $_POST['year'],
                    ':mileage' => $_POST['mileage'],
                    ':auto_id' => $_POST['auto_id']
                )
            );
            error_log("In Edit.php: SQL Query sent fo updation, and now returning to index.php");
            $_SESSION['success'] = "Record updated";
            header("Location: index.php");
            return;
        }
    }
    //TODO: Remove this part of code since all checks are done before this. 
    else {
        error_log("In Edit.php: This code should never show up.");
        // $_SESSION['error'] = "All fields are required";
        // header("Location: edit.php?autos_id=".$_REQUEST['auto_id']);
        // return;
    }
}
error_log("In Edit.php: Populating the table with data");
$stmt = $pdo->prepare("SELECT * FROM autos WHERE auto_id = :auto_id");
$stmt->execute(array("auto_id" => $_GET['auto_id']));
$rows = $stmt->fetch(PDO::FETCH_ASSOC);
if ($rows === false) {
    error_log("In Edit.php: No rows returned hence auto_id must be false");
    $_SESSION['error'] = "Bad Value for auto_id";
    header("Location: index.php");
    return;
}

error_log("In Edit.php: Cleaning make, model... with html entitites");
$make = htmlentities($rows['make']);
$model = htmlentities($rows['model']);
$year = htmlentities($rows['year']);
$mileage = htmlentities($rows['mileage']);
$auto_id = $rows['auto_id'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nishant's edit page</title>
</head>

<body>
    <p>
    <h1>Editing Automobile</p>
        <form method="POST">
            <p>Make:
                <input type="text" name="make" value="<?= $make ?>">
            </p>
            <p>Model:
                <input type="text" name="model" value="<?= $model ?>">
            </p>
            <p>Year:
                <input type="text" name="year" value="<?= $year ?>">
            </p>
            <p>Mileage:
                <input type="text" name="mileage" value="<?= $mileage ?>">
            </p>
            <input type="hidden" name="auto_id" value="<?= $auto_id ?>">
            <p><input type="submit" value="Save" />
                <a href="index.php">Cancel</a>
            </p>
        </form>
</body>

</html>