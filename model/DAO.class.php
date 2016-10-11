<?php
require_once('../model/Nouvelle.class.php');
require_once('../model/RSS.class.php');
	class DAO {
         private $db; // L'objet de la base de donnée

        // Ouverture de la base de donnée
        function __construct() {
          $dsn = 'sqlite:../data/rss.db'; // Data source name
          try {
            $this->db = new PDO($dsn);
          } catch (PDOException $e) {
            exit("Erreur ouverture BD : ".$e->getMessage());
          }
        }

        //////////////////////////////////////////////////////////
        // Methodes CRUD sur RSS
        //////////////////////////////////////////////////////////

        // Crée un nouveau flux à partir d'une URL
        // Si le flux existe déjà on ne le crée pas
        function createRSS($url) {
          $rss = $this->readRSSfromURL($url);
          if ($rss == NULL) {
            try {
              $q = "INSERT INTO RSS (url) VALUES ('$url')";
              $r = $this->db->exec($q);
              if ($r == 0) {
                die("createRSS error: no rss inserted\n");
              }
              return $this->readRSSfromURL($url);
            } catch (PDOException $e) {
              die("PDO Error :".$e->getMessage());
            }
          } else {
            // Retourne l'objet existant
            return $rss;
          }
        }


        // Acces à un objet RSS à partir de son URL
        function readRSSfromURL($url) {
		$req = "select * from RSS where url = :url";
		$sth = $this->db->prepare($req);
		$sth->execute(array($url));
		if($sth == false)
			return false;
		$a = $sth->fetchAll()[0];
		$rss = new RSS($a['url']);
		return $rss;

        }

        // Met à jour un flux
        function updateRSS(RSS $rss) {
          // Met à jour uniquement le titre et la date
          $titre = $this->db->quote($rss->titre());
          $q = "UPDATE RSS SET titre=$titre, date='".$rss->date()."' WHERE url='".$rss->url()."'";
          try {
            $r = $this->db->exec($q);
            if ($r == 0) {
              die("updateRSS error: no rss updated\n");
            }
          } catch (PDOException $e) {
            die("PDO Error :".$e->getMessage());
          }
        }

        //////////////////////////////////////////////////////////
        // Methodes CRUD sur Nouvelle
        //////////////////////////////////////////////////////////

        // Acces à une nouvelle à partir de son titre et l'ID du flux
        function readNouvellefromTitre($titre,$RSS_id) {
		$req = "select * from nouvelle where titre = :titre AND RSS_id = :id";
		$sth = $this->db->prepare($req);
		$sth->execute(array($titre,$RSS_id));
		if($sth == false)
			return false;
		return $sth->fetchAll(PDO::FETCH_CLASS,'Nouvelle');
	}

        // Crée une nouvelle dans la base à partir d'un objet nouvelle
        // et de l'id du flux auquelle elle appartient
        function createNouvelle(Nouvelle $n, $RSS_id) {
		$req = "INSERT INTO nouvelle (date,titre,description,url,image,RSS_id) values (:date,:titre,:description,:url,:image,:RSS_id)";
		$sth = $this->db->prepare($req);
		$n = $sth->execute(array($n->date,$n->titre,$n->description,$n->url,$n->image,$RSS_id));
		if ($n != 1)
			return false;
		else
			return true;
	}

	function readNouvellesFromRSS(RSS $a){
		$req = "select * from nouvelle where RSS_id = :id";
		$sth = $this->db->prepare($req);
		$sth->execute(array($RSS->id));
		if($sth == false)
			return false;
		return $sth->fetchAll(PDO::FETCH_CLASS,'Nouvelle');

	}

        // Met à jour le champ image de la nouvelle dans la base
        function updateImageNouvelle(Nouvelle $n) {
		// Met à jour uniquement le titre et la date
	}

	function RSSFromCategorie(Categorie $c){
		$req = "select r.url from RSS r, fluxcategorie f  where f.categorie = :categorie AND f.RSS_id = r.id";
		$sth = $this->db->prepare($req);
		$sth->execute(array($c->name));
		if($sth == false)
			return false;
		$result = $sth->fetchAll();
		$rsss = [];
		foreach($result as $a){
			$rsss[] = new RSS($a['url']);
		}
		return $rsss;
	}

	// GESTION DE LA BASE UTILISATEUR
	function getUserByLogin($login){
		$req = "select * from utilisateur where login = :login";
		$query = $this->db->prepare($req);
		$query->execute(array($login));
		if($query==false){
			return false;
		}
		$result = $query->fetchAll();
		return $result;
	}

	function insertNewUser($login,$pwd){
		$req = "insert INTO utilisateur(login,mp) values (:login,:pwd)";
		$query = $this->db->prepare($req);
		$query->execute(array($login,$pwd));
		if ($n < 1){
			return false;
		}else
			return true;
	}

	function insertPreferencesUser($tab,$login){
		$comte = 0;
		foreach($tab as $key => $value){
			$req = "insert INTO interets(userID,categorieID) values (:userid,:catid)";
			$query = $this->db->prepare($req);
			$query->execute(array($login,$value));
			$comte++;
		}
			if ($n < count($tab)){
				return false;
			}else
				return true;
		}
	}


      }
$dao = new DAO();

?>
