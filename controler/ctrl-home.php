<?php
include_once('../model/DAO.class.php');











$bd = array(
  array("Mode","Actu de la mode","mode.jpeg"),
  array("Finances","Actu des finances","finance.jpeg"),
  array("Sciences","Actu des sciences","science.jpeg"),
  array("Gaming","Actu du gaming","gaming.jpeg")
);
$rsss = [];
foreach($categories as $cat){
	$rss = $dao->RSSFromCategorie;
	foreach($rss as $r)
		$rsss[] = $r;
}

foreach($rsss as $rss){
	$dao->readNouvellesFromRSS($rss);

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
