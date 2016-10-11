<?php
include_once('../model/DAO.class.php');











$bd = array(
  new Categorie("Mode","Actu de la mode","mode.jpeg"),
  new Categorie("Finances","Actu des finances","finance.jpeg"),
  new Categorie("Sciences","Actu des sciences","science.jpeg"),
  new Categorie("Gaming","Actu du gaming","gaming.jpeg")
);
$rsss = [];
foreach($categories as $cat){
	$rss = $dao->RSSFromCategorie;
	foreach($rss as $r)
		$rsss[] = $r;
}

$nouvelles = [];
foreach($rsss as $rss){
	$n = $dao->readNouvellesFromRSS($rss);
	foreach($n as $nouv)
		$nouvelles[] = $nouv;
}


$cards = [];
foreach($nouvelles as $n){
	$a = [];
	$a['titre'] = $n->titre;
	$a['description'] = $n->description;
	$a['imagepath'] = '../data/images/'.$n->image.'.jpg';
	$cards[] = $a;


}







include_once('../view/home.html');
?>
