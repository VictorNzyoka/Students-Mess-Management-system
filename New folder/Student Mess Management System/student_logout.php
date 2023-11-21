<?php
session_start();
session_destroy();
header("Location: student_login.php"); // Redirect to login page
exit();
?>
