<?php
session_start();

// Only remove the current user, keep registered users in session
unset($_SESSION['current_user']);

// Redirect to home page
header("Location: index.php");
exit;
?>
