<?php

if( ! isset($_SESSION["id"])){
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
        $choix['Finance'] = ($choix['Finance']==0 && ! isset($_GET['Financebis'])) ? 1 : 0;
      }
      if(isset($_GET['Mode']) && $_GET['Mode']==1){
        $choix['Mode'] = ($choix['Mode']==0 && ! isset($_GET['Modebis'])) ? 1 : 0;
      }
      if(isset($_GET['Science']) && $_GET['Science']==1){
        $choix['Science'] = ($choix['Science']==0 && ! isset($_GET['Sciencebis'])) ? 1 : 0;
      }
      if(isset($_GET['Gaming']) && $_GET['Gaming']==1){
        $choix['Gaming'] = ($choix['Gaming']==0 && ! isset($_GET['Gamingbis'])) ? 1 : 0;
      }
  }
  insertPreferencesUser($choix,$_SESSION["id"]);
}





 ?>
