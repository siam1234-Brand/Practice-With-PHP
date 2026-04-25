<?php
session_start();

if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = array();
}

$message = "";

// Pre-fill username from cookie if "Remember Me" was checked
$saved_username = isset($_COOKIE['remember_user']) ? $_COOKIE['remember_user'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? true : false;

    // Check if user exists
    if (isset($_SESSION['users'][$username]) && $_SESSION['users'][$username]['password'] == $password) {
        // Login successful
        $_SESSION['current_user'] = $username;

        // Set or clear remember me cookie
        if ($remember) {
            // Cookie expires in 7 days
            setcookie('remember_user', $username, time() + (7 * 24 * 60 * 60), "/");
        } else {
            // Delete cookie if exists
            if (isset($_COOKIE['remember_user'])) {
                setcookie('remember_user', '', time() - 3600, "/");
            }
        }

        header("Location: dashboard.php");
        exit;
    } else {
        $message = "<p class='error'>Invalid username or password.</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>xCompany - Login</title>
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
                <legend>LOGIN</legend>
                <table>
                    <tr>
                        <td>User Name :</td>
                        <td><input type="text" name="username" value="<?php echo $saved_username; ?>"></td>
                    </tr>
                    <tr>
                        <td>Password &nbsp; :</td>
                        <td><input type="password" name="password"></td>
                    </tr>
                </table>
                <hr>
                <input type="checkbox" name="remember" <?php if($saved_username) echo 'checked'; ?>> Remember Me
                <br><br>
                <input type="submit" value="Submit">
                <a href="forgot_password.php">Forgot Password?</a>
            </fieldset>
        </form>
    </div>

    <div class="footer">Copyright &copy; 2017</div>
</div>
</body>
</html>
