<?php
require_once("../model/DAO.class.php");
session_start();

if( ! isset($_SESSION["id"])){
  print_r($_SESSION);
  die("La session n'est pas définie");
}
else{
  if( ! isset($choix)){
    $choix = [
      'Finance' => 0,
      'Mode' => 0,
      'Science' => 0,
      'Gaming' => 0
    ];
  }
  if(isset($_GET['Finance']) || isset($_GET['Mode']) || isset($_GET['Science']) || isset($_GET['Gaming'])){
      if(isset($_GET['Finance']) && $_GET['Finance']==1){
        $choix['Finance'] = ($choix['Finance']==0 && ! isset($_GET['Financebis'])) ? "Finance" : 0;
      }
      if(isset($_GET['Mode']) && $_GET['Mode']==1){
        $choix['Mode'] = ($choix['Mode']==0 && ! isset($_GET['Modebis'])) ? "Mode" : 0;
      }
      if(isset($_GET['Science']) && $_GET['Science']==1){
        $choix['Science'] = ($choix['Science']==0 && ! isset($_GET['Sciencebis'])) ? "Science" : 0;
      }
      if(isset($_GET['Gaming']) && $_GET['Gaming']==1){
        $choix['Gaming'] = ($choix['Gaming']==0 && ! isset($_GET['Gamingbis'])) ? "Gaming" : 0;
      }
  }
  print_r($_SESSION);
  $dao->insertPreferencesUser($choix,$_SESSION["id"]);
}





 ?>
