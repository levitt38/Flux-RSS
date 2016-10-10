<?php
require_once("../model/categories.php");

$bd = array(
  array("Mode","Actu de la mode","mode.jpeg"),
  array("Finance","Actu de la finance","finance.jpeg"),
  array("Science","Actu de la science","science.jpeg"),
  array("Gaming","Actu du gaming","gaming.jpeg")
);

foreach($bd as $key => $value){
  $categories[] = new Categorie($value);
}

include_once("../view/chose.html");

?>
