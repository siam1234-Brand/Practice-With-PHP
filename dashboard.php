<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['current_user'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['current_user'];
$user = $_SESSION['users'][$username];
?>
<!DOCTYPE html>
<html>
<head>
    <title>xCompany - Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="header">
        <div class="logo">X<span>Company</span></div>
        <div class="menu">
            Logged in as <a href="view_profile.php"><?php echo $user['name']; ?></a> |
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="content">
        <div class="sidebar">
            <h3>Account</h3>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="view_profile.php">View Profile</a></li>
                <li><a href="edit_profile.php">Edit Profile</a></li>
                <li><a href="change_picture.php">Change Profile Picture</a></li>
                <li><a href="change_password.php">Change Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <div class="main">
            <h2>Welcome <?php echo $user['name']; ?></h2>
        </div>
    </div>

    <div class="footer">Copyright &copy; 2017</div>
</div>
</body>
</html>
