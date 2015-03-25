<?php

// *************** GESTION DES RESERVATIONS *************** //

class RESA {
// Classe de gestion des commandes, et plus généralement des informations envoyées par l'user
// Regroupe les opérations sur la table 'resas' et permet de manipuler les informations suivantes :
// - l'ID de commande (parce qu'il faut un ID)
// - la REF fournie automatiquement lors de la validation de formulaire
// - le NOM de l'user qui effectue la commande
// - l'EMAIL nécessaire pour les échanges avec l'user
// - la RESA, liste des identifiants réservés (= serialize($_POST['items']) )
// - la DATE (au format timestamp) de réservation, nécessaire pour calculer la validité d'une commande
// - la validité (VALIDE) de la commande
// - le MSG (message) envoyé lors de la commande
// Cette classe est nécessaire pour gérer les échanges de mail et les status des articles

    // ********** PROPRIETES **********

    private $db;

    public $id;
    public $ref;
    public $user_name;
    public $email;
    public $content;
    public $date;
    public $validity;
    public $message;
    
    // ********** METHODES PRIVEES **********
    
    // ********** METHODES PUBLIQUES **********
    
    // Constructeur, dans le cas où la classe a un besoin obligatoire d'arguments
    public function __construct($basededonnees) {
        $this->db = $basededonnees;
    }

    // Enregistreur de commande (et de message au passage)    
    // Ne retourne rien
    // FIXME: à finir!
    public function logResa($ref,$nom,$email,$resa,$msg) {
        $this->ref      = $ref;
        $this->name     = $nom;
        $this->email    = $email;
        $this->content  = $resa;
        $this->message  = $msg;
        $columns = "id,ref,nom,email,resa,date,valide,msg";
        $values = "'','".$ref."','".$nom."','".$email."','".serialize($resa)."',now(),'1','".$msg."'";
        $this->db->recordAdd("resas",$columns,$values);
    }
    
}

?>