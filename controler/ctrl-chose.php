<?php
require_once("../model/Categorie.class.php");
require_once("../model/DAO.class.php");
session_start();

if( ! isset($_SESSION["id"])){
  header("Location: ../controler/ctrl-login.php");
}

$categories = $dao->getCategories();

if( ! isset($choix)){
  // Initialisation des choix
  foreach ($categories as $key => $value) {
    $choix[$value->name] = 0;
  }
}
// GESTION DE L'UI
foreach ($choix as $key => $value) {
    if(isset($_GET[$key]) && $_GET[$key]==1){
      $choix[$key] = ($choix[$key]==0 && ! isset($_GET[$key.'bis'])) ? 1 : 0;
    }
}

// Utilitaires pour la vue
function createURL($choix){ // créér une queryString en fonction des choix
  $queryString = "";
  foreach($choix as $key => $value){
    if($value==1){
      $queryString.= (strlen($queryString)==1) ? "" : "&";
      $queryString.=$key."=1";
    }
  }
  return $queryString;
}

include_once("../view/chose.html");



?>
