<?php

class Nouvelle{
        private $date;
        private $titre;
        private $description;
        private $url;
        private $image;

        // Fonctions getter
        function titre() {
          return $this->titre;
	}

        function url() {
          return $this->url;
	}

        function date() {
          return $this->date;
	}

        function description() {
          return $this->description;
	}

	function image() {
	  return $this->image;
	}

	// Récupère un flux à partir de son URL
	function update(DOMElement $item ) {
		
        $this->titre = $item->getElementsByTagName('title')->item(0)->textContent;

        $nodeList = $item->getElementsByTagName('pubDate');
        $this->date  = $nodeList->item(0)->textContent;
	$this->description = $item->getElementsByTagName('description')->item(0)->textContent;
	}

	function downloadImage(DOMElement $item, $imageId) {
		$node = $item->getElementsByTagName('enclosure')->item(0);
		if ($node != NULL){
		$node = $node->attributes->getNamedItem('url');
		if ($node != NULL) {
		// L'attribut url a été trouvé : on récupère sa valeur, c'est l'URL de l'image
			$url = $node->nodeValue;
			// On construit un nom local pour cette image : on suppose que $nomLocalImage contient un identifiant unique
			$this->image = '../data/images/'.$imageId.'.jpg';
			// On télécharge l'image à l'aide de son URL, et on la copie localement.
			file_put_contents($this->image, file_get_contents($url));
		}
		}

	}



}





?>
