<?php
//include_once('../model/DAO.class.php');
include_once('../model/Categorie.class.php');
include_once('../model/DAO.class.php');
session_start();
if(isset($_SESSION['id']) /*&& $dao->isAdmin($_SESSION['id'])*/)
	$name = $_SESSION['id'];
else
	header('Location: ../controler/ctrl-login.php');

if(isset($_GET['etat'])){
	if($_GET['etat']=="ajoutcat"){
		$alert = isset($_GET['error']);
		$error = false;
		$err = false;
		if($alert){
			$error = $_GET['error']!="success";
			$err = $_GET['error'];
		}
		include_once('../view/back_office_ajout_cat.html');
	}else if($_GET['etat']=="assocflux"){
		$categories = $dao->getCategories();
		$flux = $dao->getRSSs();
		$alert = isset($_GET['error']);
		$error = false;
		$err = false;
		if($alert){
			$error = $_GET['error']!="success";
			$err = $_GET['error'];
		}
		include_once('../view/back_office_assoc_flux.html');
	}else if($_GET['etat']=="ajoutflux"){
		$alert = isset($_GET['error']);
		$error = false;
		$err = false;
		if($alert){
			$error = $_GET['error']!="success";
			$err = $_GET['error'];
		}
		include_once('../view/back_office_ajout_flux.html');
	}
	else if($_GET['etat']=="modiffluxes"){
		$categories = $dao->getCategories();
		$fluxes = [];
		if(isset($_GET['catselected'])){
			$selected = true;

			$fluxes = $dao->RSSFromCategorie($dao->getCategorie($_GET['catselected']));
			foreach($fluxes as $f)
				$f->update();
		}else{
			$selected = false;
		}
		$alert = isset($_GET['error']);
		$error = false;
		$err = false;
		if($alert){
			$error = $_GET['error']!="success";
			$err = $_GET['error'];
		}
		include_once('../view/back_office_modif_fluxes.html');
}
}
else{
	include_once('../view/back_office_board.html');

}
?>
