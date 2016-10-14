<?php
include_once('../model/DAO.class.php');
include_once('../model/Categorie.class.php');



$categories = array(
  new Categorie(["Mode","Actu de la mode","mode.jpeg"])
);
$rsss = [];
foreach($categories as $cat){
	$rss = $dao->RSSFromCategorie($cat);
	foreach($rss as $r)
		$rsss[] = $r;
}
$nouvelles = [];
foreach($rsss as $rss){
	//if (time()-$rss->date() > 12){
		$rss->update();
		$dao->updateRSS($rss);
	//}
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
