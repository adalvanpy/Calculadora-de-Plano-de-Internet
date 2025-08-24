<?php
session_start();
session_destroy();
header("location:http://localhost:3001/login.php");
exit();
?>
