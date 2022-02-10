<?php
session_start();
$login = $_SESSION["login"];
setcookie(session_name(), '', 100);
session_unset();
session_destroy();
$_SESSION = array();
header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>SecuritySystem - log out</title>
    <meta name="description" content="Simple system for Security Company">
    <meta property="og:image" content="">
    <link rel="icon" type="image/png" sizes="64x64" href="assets/img/securitySystemIcon.png">
    <link rel="icon" type="image/png" sizes="64x64" href="assets/img/securitySystemIcon.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
</head>

<body style="background: rgb(27,36,60);">
    <p style="color: rgb(255,255,255);">Logging out...</p><a href="index.php">Go back</a>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
