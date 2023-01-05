<?php
session_start();
session_destroy();
header("Location: ../User/user_login.php");
?>