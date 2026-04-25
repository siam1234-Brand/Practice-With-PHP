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
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $filename = $_FILES['picture']['name'];
        $tmp = $_FILES['picture']['tmp_name'];

        // Save with unique name (username + filename)
        $newname = $username . "_" . $filename;
        $target = "uploads/" . $newname;

        if (move_uploaded_file($tmp, $target)) {
            $_SESSION['users'][$username]['picture'] = $newname;
            $user = $_SESSION['users'][$username];
            $message = "<p class='success'>Profile picture updated!</p>";
        } else {
            $message = "<p class='error'>Failed to upload picture.</p>";
        }
    } else {
        $message = "<p class='error'>Please select a file.</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>xCompany - Change Profile Picture</title>
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
            <form method="post" action="" enctype="multipart/form-data">
                <fieldset>
                    <legend>PROFILE PICTURE</legend>
                    <?php if ($user['picture'] != '') { ?>
                        <img src="uploads/<?php echo $user['picture']; ?>" width="100" height="100">
                    <?php } else { ?>
                        <div style="width:100px; height:100px; background:#ddd; text-align:center; line-height:100px;">No Image</div>
                    <?php } ?>
                    <br><br>
                    <input type="file" name="picture">
                    <br><br>
                    <input type="submit" value="Submit">
                </fieldset>
            </form>
        </div>
    </div>

    <div class="footer">Copyright &copy; 2017</div>
</div>
</body>
</html>
