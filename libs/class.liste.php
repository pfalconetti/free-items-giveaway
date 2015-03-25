<?php

// *************** GESTION DES ARTICLES *************** //

class LISTE {
// Classe de gestion de la liste des articles
// Regroupe les opérations possibles sur les articles

    // ********** PROPRIETES **********

    private $db;

    // ********** METHODES PRIVEES **********
    
    // ********** METHODES PUBLIQUES **********
    
    // Constructeur, dans le cas où la classe a un besoin obligatoire d'arguments
    public function __construct($basededonnees) {
        $this->db = $basededonnees;
    }
    
    // Méthode sans constructeur, dans le cas où la classe peut être instanciée sans dépendance
    public function setDb($basededonnees) {
        $this->db = $basededonnees;
    }
    
    // Récupération de tout le contenu
    // Retourne un objet d'objets
    public function getItemsAll() {
        $result = $this->db->tableGetAll("livres");
        return $result;
    }

    // Réserver un ou plusieurs articles en une seule requête
    // Nécessite un tableau avec les valeurs des ID des articles concernés
    // Ne retourne rien
    public function itemsBooking($tab) {
        for($i=0; $i<count($tab); $i++) {
            $tab[$i] = "id = '".$tab[$i]."'";
        }
        $this->db->tableUpdateMultiple("livres", "dispo = 'réservé'", $tab);
    }
    
}

?>