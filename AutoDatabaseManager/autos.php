<?php
require_once "pdo.php";

// if (!(isset($_GET['name']))) {
//     die("Name parameter missing");
// }

if (isset($_POST['logout'])) {
    header('Location: index.php');
}

if ((isset($_POST['mileage'])) && (isset($_POST['year']))) {
    if (!(is_numeric($_POST['mileage']) && is_numeric($_POST['year']))) {
        echo "<p style=\"color:red\" >Mileage and year must be numeric</p>";
    } else if (strlen($_POST['make']) < 1) {
        echo "<p style=\"color:red\" >Make is required</p>";
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
        echo "<p style=\"color:green\" >Record inserted</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nishant Autos Page</title>
</head>
<body>
    <div class="container">
        <h1>Tracking Autos for
            <?php
            echo $_GET['name'];
            ?>
        </h1>
        <form method="post">
            <p>Make:
                <input type="text" name="make" size="60">
            </p>
            <p>Year:
                <input type="text" name="year">
            </p>
            <p>Mileage:
                <input type="text" name="mileage">
            </p>
            <input type="submit" value="Add">
            <input type="submit" name="logout" value="Logout">
        </form>

        <h2>Automobiles</h2>
        <?php
        $stmt2 = $pdo->query("SELECT year, make, mileage FROM autos");
        $rows = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            echo "<ul><li>";
            echo htmlentities($row['year']);
            echo " ";
            echo htmlentities($row['make']);
            echo " ";
            echo htmlentities($row['mileage']);
            echo " / 100";
            echo "</li></ul>\n";
        }
        ?>
    </div>
</body>
</html>