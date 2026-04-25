<?php
session_start();

// Initialize users array in session if not set
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = array();
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $dd = $_POST['dd'];
    $mm = $_POST['mm'];
    $yyyy = $_POST['yyyy'];

    // Basic validation
    if ($name == "" || $email == "" || $username == "" || $password == "") {
        $message = "<p class='error'>Please fill all fields.</p>";
    } else if ($password != $confirm) {
        $message = "<p class='error'>Passwords do not match.</p>";
    } else if (isset($_SESSION['users'][$username])) {
        $message = "<p class='error'>Username already exists.</p>";
    } else {
        // Save user in session
        $_SESSION['users'][$username] = array(
            'name' => $name,
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'gender' => $gender,
            'dob' => $dd . "/" . $mm . "/" . $yyyy,
            'picture' => ''
        );
        $message = "<p class='success'>Registration successful! <a href='login.php'>Login here</a></p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>xCompany - Registration</title>
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
                <legend>REGISTRATION</legend>
                <table>
                    <tr>
                        <td>Name</td><td>:</td>
                        <td><input type="text" name="name"></td>
                    </tr>
                    <tr>
                        <td>Email</td><td>:</td>
                        <td><input type="email" name="email"></td>
                    </tr>
                    <tr>
                        <td>User Name</td><td>:</td>
                        <td><input type="text" name="username"></td>
                    </tr>
                    <tr>
                        <td>Password</td><td>:</td>
                        <td><input type="password" name="password"></td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td><td>:</td>
                        <td><input type="password" name="confirm"></td>
                    </tr>
                </table>

                <fieldset>
                    <legend>Gender</legend>
                    <input type="radio" name="gender" value="Male"> Male
                    <input type="radio" name="gender" value="Female"> Female
                    <input type="radio" name="gender" value="Other"> Other
                </fieldset>

                <fieldset>
                    <legend>Date of Birth</legend>
                    <input type="text" name="dd" size="2"> /
                    <input type="text" name="mm" size="2"> /
                    <input type="text" name="yyyy" size="4">
                    <i>(dd/mm/yyyy)</i>
                </fieldset>

                <br>
                <input type="submit" value="Submit">
                <input type="reset" value="Reset">
            </fieldset>
        </form>
    </div>

    <div class="footer">Copyright &copy; 2017</div>
</div>
</body>
</html>
