<?php

class Categorie{
  public $name;
  public $description;
  public $img;

  function __construct($tab){
    $this->name = $tab[0];
    $this->description = $tab[1];
    $this->img = $tab[2];
  }

  function name(){
	  return $this->name;
  }

  function description(){
	  return $this->description;
  }

  function image(){
	  return $this->img;
  }
}

?>
