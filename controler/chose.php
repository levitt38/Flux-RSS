<?php
require_once("../model/DAO.class.php");
session_start();

$categories = $dao->getCategories();

if( ! isset($_SESSION["id"])){
  header("Location: ../controler/ctrl-login.php");
}
else{
  if( ! isset($choix)){
  // Initialisation des choix
    foreach ($categories as $key => $value) {
      $choix[$value->name] = 0;
    }
  }
  // Gestion des choix utilisateurs à insérer
  foreach ($choix as $key => $value) {
      if(isset($_GET[$key]) && $_GET[$key]==1){
        $choix[$key] = ($choix[$key]==0 && ! isset($_GET[$key.'bis'])) ? 1 : 0;
      }
  }
  //print_r($choix);die(0);
  $dao->deletePreferencesUser($_SESSION["id"]);
  $dao->insertPreferencesUser($choix,$_SESSION["id"]);
  header("Location: ../controler/ctrl-home.php");
}





 ?>
