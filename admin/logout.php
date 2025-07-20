<?php

session_start();
session_unset();
session_destroy();

session_start(); // Start lagi untuk flash message
$_SESSION['message'] = "Berhasil logout.";
header("Location: login.php");
exit;

?>