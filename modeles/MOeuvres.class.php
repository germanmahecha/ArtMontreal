<?php
/**
 * Class Modele Oeuvres
 * 
 * @author German Mahecha
 * @version 1.0
 * @update 2015-12-14
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class MOeuvres {
	
    /**
	 *
	 * @var int Identifiant Artiste
	**/
    
    public $idOeuvre;
    public $titreOeuvre;
	public $titreVariante;
	public $technique;
    public $techniqueAng;
	public $noInternetOeuvre;
	public $description;
	public $validationOeuvre;
	public $idArrondissement;
    public $nomMateriaux;
	public $nomMateriauxAng;
	public $idCategorie;
	public $idSousCat;
    public $adresse;
    public $batiment;
    public $parc;
    public $latitude;
    public $longitude;
	
    
	  /**
	 * @var database Objet base de données qui permet la connexion
	 */
	static $database;
        
	function __construct ($idOeuvre,$titreOeuvre,$titreVariante,$technique,$techniqueAng,$noInternetOeuvre,$description,$validationOeuvre,$idArrondissement,$nomMateriaux, $nomMateriauxAng,$idCategorie, $idSousCat,$adresse,$batiment,$parc,$latitude,$longitude)
	{
		if (!isset(self::$database))
			self::$database = new PdoBDD();

    	$this->idOeuvre = $idOeuvre;
   		$this->titreOeuvre = $titreOeuvre;
		$this->titreVariante =  $titreVariante;
		$this->technique =  $technique;
        $this->techniqueAng =  $techniqueAng;
		$this->noInternetOeuvre =  $noInternetOeuvre;
		$this->description =  $description;
		$this->validationOeuvre =  $validationOeuvre;
		$this->idArrondissement =  $idArrondissement;
		$this->nomMateriaux =  $nomMateriaux;
		$this->nomMateriauxAng =  $nomMateriauxAng;
        $this->idCategorie =  $idCategorie;
		$this->idSousCat =  $idSousCat;
        $this->adresse=$adresse;
        $this->batiment=$batiment;
        $this->parc=$parc;
        $this->latitude=$latitude;
        $this->longitude=$longitude;
	}	
	function __destruct ()
	{
		
	}
	
    
	/** Getters
	 * @access public
	 * @return 
	 */
	
    public function getIdOeuvre() 
	{
		return $this->idOeuvre;		
	}
    public function getTitreOeuvre() 
	{
		return $this->titreOeuvre;		
	}
	public function getTitreVariante() 
	{
		return $this->titreVariante;		
	}
	public function getTechnique() 
	{
		return $this->technique;		
	}
    public function getTechniqueAng() 
	{
		return $this->technique;		
	}
	public function getNoInternetOeuvre() 
	{
		return $this->noInternetOeuvre;		
	}
	public function getDescription() 
	{
		return $this->description;		
	}
	public function getValidationOeuvre() 
	{
		return $this->validationOeuvre;		
	}
	public function getIdArrondissement() 
	{
		return $this->idArrondissement;		
	}
	public function getNomMateriaux() 
	{
		return $this->nomMateriaux;		
	}
	public function getNomMateriauxAng() 
	{
		return $this->nomMateriauxAng;		
	}
    
    public function getIdCategorie() 
	{
		return $this->idCategorie;		
	}
	
    public function getIdSousCat() 
	{
		return $this->idSousCat;		
	}
	
    public function getAdresse() 
	{
		return $this->adresse;		
	}
        
    public function getBatiment() 
	{
		return $this->batiment;		
	}
    
    public function getParc() 
	{
		return $this->parc;		
	}
     
    public function getLatitude() 
	{
		return $this->latitude;		
	}
    
    public function getLongitude() 
	{
		return $this->longitude;		
	}
    
	/*****************************************/
	

    /**
	 * @access public static
     * @author German Mahecha
	 * @return Array Tableau contenant la liste de tout
	 */
	public static function listeOeuvres() {
		self::$database->query('SELECT * FROM oeuvre');
		
        $lignes = self::$database->resultset();
		foreach ($lignes as $ligne) {	
            $uneOeuvre = new MOeuvres($ligne['idOeuvre'],$ligne['titreOeuvre'],$ligne['titreVariante'],$ligne['technique'],$ligne['techniqueAng'],
                                    $ligne['noInterne'],$ligne['description'],$ligne['validationOeuvre'],$ligne['idArrondissement'],$ligne['nomMateriaux'], $ligne['nomMateriauxAng'],$ligne['idCategorie'],$ligne['idSousCategorie'],$ligne['adresseCivic'],$ligne['batiment'],$ligne['parc'],$ligne['latitude'],$ligne['longitude']);
			$oeuvres[] = $uneOeuvre;
		}
		return $oeuvres;
	}


	/**
	 * @access public static
     * @author Jorge Blanco
	 * @return Array Tableau contenant la liste de tout avec un limit 
	 */
	public static function listeOeuvres_limit($depart, $oeuvresParPage) {
		self::$database->query('SELECT * FROM oeuvre ORDER by idOeuvre ASC LIMIT '.$depart.','.$oeuvresParPage);
		
        $lignes = self::$database->resultset();
		foreach ($lignes as $ligne) {	
            $uneOeuvre = new MOeuvres($ligne['idOeuvre'],$ligne['titreOeuvre'],$ligne['titreVariante'],$ligne['technique'],$ligne['techniqueAng'],
                                    $ligne['noInterne'],$ligne['description'],$ligne['validationOeuvre'],$ligne['idArrondissement'],$ligne['nomMateriaux'], $ligne['nomMateriauxAng'],$ligne['idCategorie'],$ligne['idSousCategorie'],$ligne['adresseCivic'],$ligne['batiment'],$ligne['parc'],$ligne['latitude'],$ligne['longitude']);
			$oeuvres[] = $uneOeuvre;
		}
		return $oeuvres;
	}
    
 
    /*
     * Fonction qui récupère les infos d'une oeuvre selon son id
	 * @access public static
     * @author Gautier Piatek
	 * @return array
	 */
	public static function getOeuvreParId($idOeuvre) 
	{
		self::$database->query("SELECT * FROM oeuvre WHERE idOeuvre=:idOeuvre");
        //On lie les paramètres auxvaleurs
        self::$database->bind(':idOeuvre', $idOeuvre);
        return (self::$database->uneLigne());
	}
    
    
    /**
	 * @access public static
     * @author Gautier Piatek
	 * @return Array Tableau contenant la liste de tous les objets oeuvres selon un id d'artiste
	 */
	public static function listeOeuvresParArtiste($idArtiste) {
		self::$database->query('SELECT * FROM oeuvre JOIN oeuvre_artiste ON oeuvre.idOeuvre=oeuvre_artiste.idOeuvre WHERE oeuvre_artiste.idArtiste = :idArtiste ORDER BY oeuvre.idOeuvre ASC');
        self::$database->bind(':idArtiste', $idArtiste);
		$lignes = self::$database->resultset();
		foreach ($lignes as $ligne) {
			$uneOeuvre = new MOeuvres($ligne['idOeuvre'],$ligne['titreOeuvre'],$ligne['titreVariante'],$ligne['technique'],$ligne['techniqueAng'],
                                    $ligne['noInterne'],$ligne['description'],$ligne['validationOeuvre'],$ligne['idArrondissement'],$ligne['nomMateriaux'], $ligne['nomMateriauxAng'],$ligne['idCategorie'],$ligne['idSousCategorie'],$ligne['adresseCivic'],$ligne['batiment'],$ligne['parc'],$ligne['latitude'],$ligne['longitude']);
			$oeuvres[] = $uneOeuvre;
		}
		return $oeuvres;
    }

    /**
	 *
	 * @return Array Tableau contenant la liste de toutes les oueuvres par arrondissement
     * @author Jorge Blanco
     * @author German Mahecha
     * @version 1.1
     * 
     */
	public static function listerOeuvresParArr($idArrondissement) {
		self::$database->query('SELECT * FROM oeuvre WHERE oeuvre.idArrondissement=:idArrondissement');
		self::$database->bind(':idArrondissement', $idArrondissement);
		$lignes = self::$database->resultset();
		foreach ($lignes as $ligne) {
			$uneOeuvre = new MOeuvres($ligne['idOeuvre'],$ligne['titreOeuvre'],$ligne['titreVariante'],$ligne['technique'],$ligne['techniqueAng'],
                                    $ligne['noInterne'],$ligne['description'],$ligne['validationOeuvre'],$ligne['idArrondissement'],$ligne['nomMateriaux'], $ligne['nomMateriauxAng'],$ligne['idCategorie'],$ligne['idSousCategorie'],$ligne['adresseCivic'],$ligne['batiment'],$ligne['parc'],$ligne['latitude'],$ligne['longitude']);
			$ouvres[] = $uneOeuvre;
		}
		
		if(isset($ouvres))
			return $ouvres;
		else
			echo "";
        
    }//FIN FUNCTION listerOeuvresParArr


     /**
	 *
	 * @return Array Tableau contenant la liste de toutes les oeuvres par CATEGORIE
     * @author Thuy Tien Vo
     * @author German Mahecha
     * @author Gautier Piatek
     * @version 1.1
     * 
     */


	public static function listeOeuvresParCat($idSousCategorie) {
		self::$database->query('SELECT * FROM oeuvre WHERE oeuvre.idSousCategorie=:idSousCategorie');
		self::$database->bind(':idSousCategorie', $idSousCategorie);
		$lignes = self::$database->resultset();
		foreach ($lignes as $ligne) {
			$uneOeuvre = new MOeuvres($ligne['idOeuvre'],$ligne['titreOeuvre'],$ligne['titreVariante'],$ligne['technique'],$ligne['techniqueAng'], $ligne['noInterne'],$ligne['description'],$ligne['validationOeuvre'],$ligne['idArrondissement'],$ligne['nomMateriaux'], $ligne['nomMateriauxAng'],$ligne['idCategorie'],$ligne['idSousCategorie'],$ligne['adresseCivic'],$ligne['batiment'],$ligne['parc'],$ligne['latitude'],$ligne['longitude']);
			$oeuvres[] = $uneOeuvre;
		}
		if(isset($oeuvres))
        	return $oeuvres;
        else
            echo "il n'y a pas d'oeuvres dans cette catégorie";            
    }


    /**
	 * Fonction d'ajout d'oeuvre
	 * @return none
     * @author Gautier Piatek
     * @author German Mahecha
     * @version 1.0
     * 
     */
    public static function ajouterOeuvre($titre, $titreVariante, $technique, $techniqueAng,$noInternetOeuvre, $description, $validationOeuvre, $idArrondissement, $nomMateriaux, $nomMateriauxAng,$idCategorie, $idSousCategorie,$adresse,$batiment,$parc,$latitude,$longitude) {
        
        self::$database->query("INSERT INTO oeuvre VALUES ('', :titre, :titreVariante, :technique, :techniqueAng, :noInternetOeuvre, :description, :validationOeuvre, :idArrondissement, :nomMateriaux, :nomMateriauxAng, :idCategorie, :idSousCategorie,:adresse,:batiment,:parc,:latitude,:longitude)");
        //On lie les paramètres auxvaleurs
        
        self::$database->bind(':titre', $titre);
        self::$database->bind(':titreVariante', $titreVariante);
        self::$database->bind(':technique', $technique);
        self::$database->bind(':techniqueAng', $techniqueAng);
        self::$database->bind(':noInternetOeuvre', $noInternetOeuvre);
        self::$database->bind(':description', $description);
        self::$database->bind(':validationOeuvre', $validationOeuvre);
        self::$database->bind(':idArrondissement', $idArrondissement);
        self::$database->bind(':nomMateriaux', $nomMateriaux);
        self::$database->bind(':nomMateriauxAng', $nomMateriauxAng);
        self::$database->bind(':idCategorie', $idCategorie);
        self::$database->bind(':idSousCategorie', $idSousCategorie);
         self::$database->bind(':adresse', $adresse);
         self::$database->bind(':batiment', $batiment);
         self::$database->bind(':parc', $parc);
         self::$database->bind(':latitude', $latitude);
         self::$database->bind(':longitude', $longitude);
        
        
        return(self::$database->execute());
        
    }
    
    /**
	 * Fonction de modification d'oeuvre
	 * @return none
     * @author Gautier Piatek
     * @author German Mahecha
     * @version 1.0
     * 
     */
    public static function modifierOeuvre($idOeuvre, $titre, $titreVariante, $technique, $techniqueAng, $description, $validationOeuvre, $idArrondissement, $idCategorie, $idSousCategorie, $nomMateriaux, $nomMateriauxAng, $adresse, $batiment, $parc, $latitude, $longitude) {
        
        self::$database->query("UPDATE oeuvre SET titreOeuvre = :titre, titreVariante = :titreVariante, technique = :technique, techniqueAng = :techniqueAng, description = :description, validationOeuvre = :validationOeuvre, idArrondissement = :idArrondissement, nomMateriaux = :nomMateriaux, nomMateriauxAng = :nomMateriauxAng, idCategorie = :idCategorie, idSousCategorie = :idSousCategorie,adresseCivic=:adresse,batiment=:batiment,parc=:parc,latitude=:latitude, longitude=:longitude WHERE idOeuvre = :idOeuvre");
        //On lie les paramètres auxvaleurs
        
        self::$database->bind(':idOeuvre', $idOeuvre);
        self::$database->bind(':titre', $titre);
        self::$database->bind(':titreVariante', $titreVariante);
        self::$database->bind(':technique', $technique);
        self::$database->bind(':techniqueAng', $techniqueAng);
        self::$database->bind(':description', $description);
        self::$database->bind(':validationOeuvre', $validationOeuvre);
        self::$database->bind(':idArrondissement', $idArrondissement);
        self::$database->bind(':nomMateriaux', $nomMateriaux);
        self::$database->bind(':nomMateriauxAng', $nomMateriauxAng);
        self::$database->bind(':idCategorie', $idCategorie);
        self::$database->bind(':idSousCategorie', $idSousCategorie);
        self::$database->bind(':adresse', $adresse);
         self::$database->bind(':batiment', $batiment);
         self::$database->bind(':parc', $parc);
         self::$database->bind(':latitude', $latitude);
         self::$database->bind(':longitude', $longitude);
        return(self::$database->execute());
        
    }
    
    
    /**
     * Fonction qui récupère le dernier Id inséré dans la BDD
	 * @access public static
     * @author Gautier Piatek
	 * @return int
	 */
    public static function recupererDernierId() {
        return(self::$database->dernierId());
    }

    /**
     * Fonction qui supprime une oeuvre de la BDD
	 * @access public static
     * @author Gautier Piatek
	 * @return none
	 */
    public static function supprimerOeuvre($idOeuvre) {
        self::$database->query("DELETE FROM oeuvre WHERE idOeuvre=:idOeuvre");
        //On lie les paramètres auxvaleurs
        self::$database->bind(':idOeuvre', $idOeuvre);
        return(self::$database->execute());
    }
        
    /**
     * Fonction qui récupère la recherche des oeuvres par mot
	 * @access public static
     * @author German Mahecha
	 * @return array
	 */
    
    public static function listeOeuvresparMot($mot) {
       self::$database->query("SELECT * FROM oeuvre WHERE oeuvre.titreOeuvre LIKE '%$mot%'");
		$lignes = self::$database->resultset();
		foreach ($lignes as $ligne) {
			$uneOeuvre = new MOeuvres($ligne['idOeuvre'],$ligne['titreOeuvre'],$ligne['titreVariante'],$ligne['technique'],$ligne['techniqueAng'],
                                    $ligne['noInterne'],$ligne['description'],$ligne['validationOeuvre'],$ligne['idArrondissement'],$ligne['nomMateriaux'], $ligne['nomMateriauxAng'],$ligne['idCategorie'],$ligne['idSousCategorie'],$ligne['adresseCivic'],$ligne['batiment'],$ligne['parc'],$ligne['latitude'],$ligne['longitude']);
			$oeuvres[] = $uneOeuvre;
		}
        return $oeuvres;
    }
    
    /**
     * Fonction qui compte le nombre d'oeuvres dans la BDD
	 * @access public static
     * @author Gautier Piatek
	 * @return int
	 */
    
    public static function nbreOeuvres() {
        self::$database->query("SELECT COUNT(idOeuvre) FROM oeuvre;");
        $resultat = self::$database->uneLigne();
        
        return $resultat["COUNT(idOeuvre)"];
    }

     /**
     * Function qui valide s'il existe un oeuvre dasn la table oeuvres
	 * @author German Mahecha
	 * @return idOeuvre ou false
	 */


    public function validerOeuvre()
    {
        self::$database->query("SELECT * FROM oeuvre WHERE noInterne = :noInterne");
        //On lie les paramètres aux valeurs
        self::$database->bind(':noInterne', $this->noInternetOeuvre);
        $ligne=self::$database->uneLigne();
        return $ligne['idOeuvre'];
    } 
    
     /**
     * Function qui affiche la date de maj de la BDD
	 * @author Gautier Piatek
	 * @return string
	 */


    public function afficheMajBdd()
    {
        self::$database->query("SELECT * FROM bdd");
        $ligne=self::$database->uneLigne();
        return $ligne['dateMaj'];
    } 
    
     /**
     * Function qui enregistre la date et heyre de mise à jour de la BDD
	 * @author Gautier Piatek
	 * @return none
	 */

    

    public function enregistrerMajBdd($date) 
    {
        self::$database->query("UPDATE bdd SET dateMaj = :date");
        //On lie les paramètres aux valeurs
        self::$database->bind(':date', $date);
        self::$database->execute();
    }
    
    
     /*
     * Fonction qui récupère les infos d'une oeuvre selon un idPhoto
	 * @access public static
     * @author German Mahecha
	 * @return array
	 */
	public static function getOeuvreParIdPhoto($idPhoto) 
	{
		self::$database->query("SELECT * FROM oeuvre 
                                JOIN photo ON oeuvre.idOeuvre = photo.idOeuvre
                                WHERE photo.idPhoto=:idPhoto");
        //On lie les paramètres auxvaleurs
        self::$database->bind(':idPhoto', $idPhoto);
        return (self::$database->uneLigne());
	}
    
    /* function qui compte les oeuvres non valides
	 * @access public static
     * @author Gautier Piatek
	 * @return int
	 */
    public static function nbreOeuvresNonValides() {
        self::$database->query("SELECT COUNT(idOeuvre) FROM oeuvre WHERE validationOeuvre = 0;");
        $resultat = self::$database->uneLigne();
        
        return $resultat["COUNT(idOeuvre)"];  
    }
    
    /* function qui valide les oeuvres et leurs photos en attente de validation
	 * @access public static
     * @author Gautier Piatek
	 * @return none
	 */
    public static function validerOeuvrePhoto($idOeuvre) 
    {
        self::$database->query("UPDATE oeuvre SET validationOeuvre = 1 WHERE idOeuvre = :idOeuvre");
        self::$database->bind(':idOeuvre', $idOeuvre);
        self::$database->execute();
        self::$database->query("UPDATE photo SET validationPhoto = 1 WHERE idOeuvre = :idOeuvre");
        self::$database->bind(':idOeuvre', $idOeuvre);
        self::$database->execute();
        
    }
    
    /* function qui liste les commentaires à valider
	 * @access public static
     * @author Gautier Piatek
	 * @return array
	 */
    public static function listeOeuvresAValider() 
    {
         $oeuvres=array();
        self::$database->query("SELECT utilisateur_enregistre.loginUtilisateur, propose.dateProposition, photo.idPhoto, photo.nomPhoto, oeuvre.titreOeuvre, oeuvre.idOeuvre
FROM oeuvre
JOIN photo ON photo.idOeuvre = oeuvre.idOeuvre
JOIN propose ON propose.idPhoto = photo.idPhoto 
JOIN utilisateur_enregistre ON propose.idUtilisateur= utilisateur_enregistre.idUtilisateur 
WHERE oeuvre.validationOeuvre=0");
        $lignes = self::$database->resultset();
		foreach ($lignes as $ligne) {
			$uneOeuvre = array($ligne['loginUtilisateur'], $ligne['dateProposition'], $ligne['idPhoto'], $ligne['nomPhoto'], $ligne['titreOeuvre'], $ligne['idOeuvre']);
			$oeuvres[] = $uneOeuvre;
		}
		return $oeuvres;
    }
    
    /* function qui récupère la latitude et longitude depuis une adresse
	 * @access public static
     * @author Gautier Piatek
	 * @return array
	 */
    public static function getLatLongAdresse($addresse)
    {
        $coordonnees=array();
        $url_base="http://maps.googleapis.com/maps/api/geocode/xml?";
        $requete = $url_base . "address=" . urlencode($addresse).'&sensor=false&region=CA';
        $xml = simplexml_load_file($requete) or die("Erreur chargement");
        
        $coordonnees['lat']=$coordonnees['lon']='';
        $coordonnees['status'] = $xml->status ;
        if($coordonnees['status']=='OK')
        {
            $coordonnees['lat'] = $xml->result->geometry->location->lat ;
            $coordonnees['lon'] = $xml->result->geometry->location->lng ;
        }
        return $coordonnees;
    }

}
?>