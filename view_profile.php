<?php
session_start();

if (!isset($_SESSION['current_user'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['current_user'];
$user = $_SESSION['users'][$username];

// Default picture if none uploaded
$picture = ($user['picture'] != '') ? $user['picture'] : 'default.png';
?>
<!DOCTYPE html>
<html>
<head>
    <title>xCompany - View Profile</title>
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
            <fieldset>
                <legend>PROFILE</legend>
                <table>
                    <tr>
                        <td>
                            <table>
                                <tr><td>Name</td><td>: <?php echo $user['name']; ?></td></tr>
                                <tr><td>Email</td><td>: <?php echo $user['email']; ?></td></tr>
                                <tr><td>Gender</td><td>: <?php echo $user['gender']; ?></td></tr>
                                <tr><td>Date of Birth</td><td>: <?php echo $user['dob']; ?></td></tr>
                            </table>
                        </td>
                        <td valign="top">
                            <?php if ($user['picture'] != '') { ?>
                                <img src="uploads/<?php echo $user['picture']; ?>" width="100" height="100">
                            <?php } else { ?>
                                <div style="width:100px; height:100px; background:#ddd; text-align:center; line-height:100px;">No Image</div>
                            <?php } ?>
                            <br>
                            <a href="change_picture.php">Change</a>
                        </td>
                    </tr>
                </table>
                <br>
                <a href="edit_profile.php">Edit Profile</a>
            </fieldset>
        </div>
    </div>

    <div class="footer">Copyright &copy; 2017</div>
</div>
</body>
</html>
