<?php
// Do not put any HTML above this line
session_start();
if (isset($_POST['cancel'])) {
    // Redirect the browser to game.php
    header("Location: index.php");
    return;
}

if (isset($_SESSION['error'])) {
    echo ('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
    unset($_SESSION['error']);
}

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1'; // Pw is php123

$failure = false; // If we have no POST data

// Check to see if we have some POST data, if we do process it
if (isset($_POST['email']) && isset($_POST['pass'])) {
    if (strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1) {
        $failure = "User name and password are required";
    } elseif (strpos($_POST['email'], "@") !== false) {
        $check = hash('md5', $salt . $_POST['pass']);
        if ($check != $stored_hash) {
            $_SESSION['error'] = "Incorrect Password";
            error_log("Login fail " . $_POST['email'] . " $check");
            echo "Incorrect password";
        } else {
            error_log("Login success " . $_POST['email']);
            $_SESSION['name'] = $_POST['email'];
            echo $_SESSION['name'];
            header("Location: view.php");
            return;
        }
    } else {
        $failure = "Email must have an at-sign (@)";
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: login.php");
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
    <title>Nishant's Login Page</title>
</head>

<body>
    <div class="container">
        <h1>Please Log In</h1>
        <form method="POST">
            <label for="nam">User Name</label>
            <input type="text" name="email"><br />
            <label for="id_1723">Password</label>
            <input type="text" name="pass"><br />
            <input type="submit" name="login" value="Log In">
            <input type="submit" name="cancel" value="Cancel">
        </form>
    </div>
</body>

</html>