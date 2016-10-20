<?php

session_start();

if ( isset($_SESSION["id"]) ){
  header("Location: ../controler/ctrl-home.php");
}

include_once("../view/login.html");


?>
