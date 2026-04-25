<?php
session_start();

if (!isset($_SESSION['current_user'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['current_user'];
$user = $_SESSION['users'][$username];
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current = $_POST['current'];
    $new = $_POST['new'];
    $retype = $_POST['retype'];

    if ($current != $user['password']) {
        $message = "<p class='error'>Current password is wrong.</p>";
    } else if ($new != $retype) {
        $message = "<p class='error'>New passwords do not match.</p>";
    } else if ($new == "") {
        $message = "<p class='error'>New password cannot be empty.</p>";
    } else {
        $_SESSION['users'][$username]['password'] = $new;
        $message = "<p class='success'>Password changed successfully!</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>xCompany - Change Password</title>
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
            <?php echo $message; ?>
            <form method="post" action="">
                <fieldset>
                    <legend>CHANGE PASSWORD</legend>
                    <table>
                        <tr>
                            <td>Current Password</td><td>:</td>
                            <td><input type="password" name="current"></td>
                        </tr>
                        <tr>
                            <td style="color:green;">New Password</td><td>:</td>
                            <td><input type="password" name="new"></td>
                        </tr>
                        <tr>
                            <td style="color:red;">Retype New Password</td><td>:</td>
                            <td><input type="password" name="retype"></td>
                        </tr>
                    </table>
                    <br>
                    <input type="submit" value="Submit">
                </fieldset>
            </form>
        </div>
    </div>

    <div class="footer">Copyright &copy; 2017</div>
</div>
</body>
</html>
