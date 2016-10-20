<?php
require_once("../model/DAO.class.php");
require_once("../model/Categorie.class.php");
session_start();

if( ! isset($_SESSION["id"])){
  header("Location: ../controler/ctrl-login.php");
}

$preferences = $dao->getPreferencesUser($_SESSION["id"]);
foreach ($preferences as $key => $value){
  $choix[$value->name] = 1;
}

include_once("../view/option.html");

?>
