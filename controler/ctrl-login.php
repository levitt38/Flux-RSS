<?php

if ( isset($_COOKIE['id']) && !isset($_SESSION["userId"]) ){
  $_SESSION["userId"] = $_COOKIE['id'];
  header("Location: ctrl-flux.php");
}

include_once("../view/login.html");


?>
