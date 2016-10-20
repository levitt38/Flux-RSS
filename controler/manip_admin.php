<?php

function error($etat,$reason){
	header("Location: ../controler/ctrl-back-office.php?error=$reason&etat=$etat");
	}

function success($etat){
	header("Location: ../controler/ctrl-back-office.php?error=success&etat=$etat");
}

if(isset($_POST['etat'])){
	include_once("../model/DAO.class.php");
	include_once("../model/Categorie.class.php");
	$etat = $_POST['etat'];
}else
	header("../controler/ctrl-back-office.php");

if($etat == "ajoutcat"){
	if(isset($_POST['nom']) && $_POST['nom']!="")
		$nom = $_POST['nom'];
	else
		error($etat,"noname");
	if(isset($_POST['lien']))
		$imglink = $_POST['lien'];
	else
		error($etat,"nolink");
	if(isset($_POST['description']))
		$description = $_POST['description'];
	else
		error($etat,"nodescription");
	if($dao->createCategorie(new Categorie(array($nom,$description,$imglink)))){

		success($etat);
	}	else{
		error($etat,"nametaken");
	}
}
else if($etat == "assocflux"){
	if(isset($_POST['categorie']) && $_POST['categorie']!="")
		$cat = $_POST['categorie'];
	else
		error($etat,"nocat");
	if(isset($_POST['flux']) && $_POST['flux']!="")
		$flux = $_POST['flux'];
	else
		error($etat,"noflux");
	if($dao->ajoutFluxCategorie($flux,$dao->getCategorie($cat))){
		success($etat);
	}	else{
		error($etat,"nametaken");
	}
}else if($etat == "ajoutflux"){
	include_once("../model/DAO.class.php");
	if(isset($_POST['lien']))
		$imglink = $_POST['lien'];
	else
		error($etat,"nolink");
	if($dao->createRSS($_POST['lien'])){

		success($etat);
	}	else{
		error($etat,"nametaken");
	}
}else if($etat == "modifcat"){
	if(isset($_POST['nom']) && $_POST['nom']=="")
		$nom = $_POST['nom'];
	else
		error($etat,"noname");
	if(isset($_POST['lien']))
		$imglink = $_POST['lien'];
	else
		error($etat,"nolink");
	if(isset($_POST['description']))
		$description = $_POST['description'];
	else
		error($etat,"nodescription");
	if($dao->createCategorie(new Categorie(array($nom,$description,$imglink)))){

		success($etat);
	}	else{
		error($etat,"nametaken");
	}
}else if($etat == "modiffluxes"){
	if(isset($_POST['delete']))
		$flux = $_POST['delete'];
	else
		error($etat,"noflux");
	if(isset($_POST['catselected']))
		$cat = $_POST['catselected'];
	else
		error($etat,"nocat");

	if($dao->removeFluxCategorie($flux,$dao->getCategorie($cat))){
		success($etat);
	}	else{
		error($etat,"notincat");
	}

}


?>
