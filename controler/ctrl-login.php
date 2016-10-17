<?php

if ( isset($_COOKIE['id']) && !isset($_SESSION["id"]) ){
  $_SESSION["id"] = $_COOKIE['id'];
  header("Location: ctrl-home.php");
}

include_once("../view/login.html");


?>
