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
    $_SESSION['users'][$username]['name'] = $_POST['name'];
    $_SESSION['users'][$username]['email'] = $_POST['email'];
    $_SESSION['users'][$username]['gender'] = $_POST['gender'];
    $_SESSION['users'][$username]['dob'] = $_POST['dob'];

    // Refresh the user data
    $user = $_SESSION['users'][$username];
    $message = "<p class='success'>Profile updated successfully!</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>xCompany - Edit Profile</title>
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
                    <legend>EDIT PROFILE</legend>
                    <table>
                        <tr>
                            <td>Name</td><td>:</td>
                            <td><input type="text" name="name" value="<?php echo $user['name']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Email</td><td>:</td>
                            <td><input type="email" name="email" value="<?php echo $user['email']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Gender</td><td>:</td>
                            <td>
                                <input type="radio" name="gender" value="Male" <?php if($user['gender']=='Male') echo 'checked'; ?>> Male
                                <input type="radio" name="gender" value="Female" <?php if($user['gender']=='Female') echo 'checked'; ?>> Female
                                <input type="radio" name="gender" value="Other" <?php if($user['gender']=='Other') echo 'checked'; ?>> Other
                            </td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td><td>:</td>
                            <td>
                                <input type="text" name="dob" value="<?php echo $user['dob']; ?>">
                                <br><i>(dd/mm/yyyy)</i>
                            </td>
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
