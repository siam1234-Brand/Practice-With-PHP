<?php
session_start();

if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = array();
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $found = false;

    // Search for user with this email
    foreach ($_SESSION['users'] as $user) {
        if ($user['email'] == $email) {
            $found = true;
            $message = "<p class='success'>Your password is: <b>" . $user['password'] . "</b></p>";
            break;
        }
    }

    if (!$found) {
        $message = "<p class='error'>Email not found.</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>xCompany - Forgot Password</title>
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
        <?php echo $message; ?>
        <form method="post" action="">
            <fieldset>
                <legend>FORGOT PASSWORD</legend>
                Enter Email: <input type="email" name="email">
                <br><br>
                <input type="submit" value="Submit">
            </fieldset>
        </form>
    </div>

    <div class="footer">Copyright &copy; 2017</div>
</div>
</body>
</html>
