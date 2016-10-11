<?php
require_once("../model/categories.php");

$bd = array(
  array("Mode","Actu de la mode","mode.jpeg"),
  array("Finance","Actu de la finance","finance.jpeg"),
  array("Science","Actu de la science","science.jpeg"),
  array("Gaming","Actu du gaming","gaming.jpeg")
);

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

foreach($bd as $key => $value){
  $categories[] = new Categorie($value);
}

include_once("../view/chose.html");

function createURL($tab){
  $queryString = "";
  foreach($tab as $key => $value){
    if($value==1){
      $queryString.= (strlen($queryString)==1) ? "" : "&";
      $queryString.=$key."=1";
    }
  }
  return $queryString;
}

?>
