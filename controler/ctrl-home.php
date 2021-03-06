<?php
require_once('../model/DAO.class.php');
require_once('../model/Categorie.class.php');

session_start();
if(isset($_SESSION['id']))
	$name = $_SESSION['id'];
else
	header('Location: ../controler/ctrl-login.php');

$categories = $dao->getPreferencesUser($name);
if(count($categories)<1)
	header('Location: ../controler/ctrl-chose.php');
$rsss = [];
foreach($categories as $cat){
	$rss = $dao->RSSFromCategorie($cat);
	foreach($rss as $r)
		$rsss[] = $r;
}
$rss = $dao->getAbonnementsUser($name);
            
foreach($rss as $r)
	$rsss[] = $r;
$nouvelles = [];

foreach($rsss as $rss){

	if (time()-$rss->date() > 120){
		$rss->update();
		$dao->updateRSS($rss);
	}
	$n = $dao->readNouvellesFromRSS($rss);
	foreach($n as $nouv)
		$nouvelles[] = $nouv;
}
$cards = [];
foreach($nouvelles as $n){
	$a = [];
	$a['titre'] = $n->titre();
	$a['description'] = $n->description();
	$a['imagepath'] = $n->image();
	$cards[] = $a;


}


include_once('../view/home.html');
?>
