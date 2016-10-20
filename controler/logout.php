<?php
session_start();
$_SESSION["id"] = null;

header("Location: ../controler/ctrl-login.php");

?>
