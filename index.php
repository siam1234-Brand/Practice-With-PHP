<?php
session_start();

// If already logged in, go to dashboard
if (isset($_SESSION['current_user'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>xCompany - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="header">
        <div class="logo">X<span>Company</span></div>
        <div class="menu">
            <a href="index.php">Home</a> |
            <a href="login.php">Login</a> |
            <a href="registration.php">Registration</a>
        </div>
    </div>

    <div class="content">
        <h2>Welcome to xCompany</h2>
    </div>

    <div class="footer">Copyright &copy; 2017</div>
</div>
</body>
</html>
