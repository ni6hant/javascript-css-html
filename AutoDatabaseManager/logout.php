<?php
require_once "pdo.php";

session_start();
session_destroy();
header('Location: index.php');
?>


<html>

<head>
    <title>Nishant's Logout Page</title>
</head>

<body>
<h1>You have successfully logged out.</h1>
    </p>
</body>

</html>