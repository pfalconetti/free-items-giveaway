<?php

// *************** GESTION DE LA BASE DE DONNEES *************** //

class DB {
// Classe de gestion de la base de données
// Regroupe les opérations habituelles et les constructeurs de requêtes
// Classe isolée avec méthodes publiques afin d'être utilisée par d'autres classes
// Ref: http://studio.jacksay.com/tutoriaux/php/connection-mysql-avec-pdo

    // ********** PROPRIETES **********

    private $_connexion;

    // ********** METHODES PRIVEES (orientées techno de BDD) **********
    
    // Connection au serveur et à la BDD : ouvre une connexion MySQL
    // Penser à fermer la connexion par la suite à chaque fois qu'on utilise cette fonction
    private function dbConnect() {
        try {
            $dns = 'mysql:host=myDbHost;dbname=myDbName';
            $usr = 'myUser';
            $pwd = 'myPassword';
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            $this->_connexion = new PDO( $dns, $usr, $pwd, $options );
        } catch ( Exception $e ) {
            echo "Connection à MySQL impossible : ", $e->getMessage();
            die();
        }
    }
    
    // CREATE: Constructeur de requête INSERT
    // $columns et $values sont des listes de valeurs alphanumériques séparées par des virgules
    // Retourne une requête dans le format utilisé
    private function create($table,$columns,$values) {
        $req = "INSERT INTO ";
        $req.= $table." (".$columns.") ";
        $req.= "VALUES(".$values.") ;";
        return $req;
    }
    
    // READ: Constructeur de requête SELECT
    // Retourne une requête dans le format utilisé
    private function read($table,$column,$condition="") {
        $req = "SELECT ".$column." ";
        $req.= "FROM ".$table." ";
        if($condition)
            $req.= "WHERE ".$where." ";
        $req.= ";";
        return $req;
    }
    
    // UPDATE: Constructeur de requête UPDATE
    // Retourne une requête dans le format utilisé
    private function update($table,$set,$condition) {
        $req = "UPDATE ".$table." ";
        $req.= "SET ".$set." ";
        $req.= "WHERE ".$condition." ;";
        return $req;
    }
    
    // Executeur basique de requête
    // Nécessite une requête MySQL en paramètre
    private function dbExec($sql) {
        $this->dbConnect();
        try {
            $statement = $this->_connexion->prepare($sql);
            $statement->execute();
        } catch ( Exception $e ) {
            echo $sql." --> ERREUR : ".$e->getMessage()."<br/>";
        }
        $this->_connexion = null;
    }
    
    // ********** METHODES PUBLIQUES (driver) **********

    // Exécuteur d'ajout d'enregistrement
    // Ne retourne rien
    public function recordAdd($table,$columns,$values) {
        $sql = $this->create($table,$columns,$values);
        $this->dbExec($sql);
    }
    
    // Récupération de tout le contenu d'une table donnée
    // Nécessite le nom de la table
    // Retourne un objet d'objets
    public function tableGetAll($table) {
        $result = new ArrayObject() ;
        $sql = $this->read($table,"*");
        $this->dbConnect();
        try {
            $statement = $this->_connexion->prepare($sql);
            $statement->execute();
            while($row = $statement->fetchObject()) {
                $result->offsetSet(NULL, $row);
            }
        } catch ( Exception $e ) {
            echo $sql." --> ERREUR : ".$e->getMessage()."<br/>";
        }
        $this->_connexion = null;
        return $result;
    }
    
    // Exécuteur de mise à jour de plusieurs lignes en une seule requête
    // Nécessite le nom de la table ($table), la valeur à remplacer ($set), et un tableau avec les conditions d'application ($conditionstab)
    // Ne retourne rien
    public function tableUpdateMultiple($table,$set,$conditionstab) {
        if(count($conditionstab)>100) echo "ATTENTION: trop de requêtes concaténées!<br/>"; // FIXME: à optimiser!
        $sql = "";
        foreach($conditionstab as $condition) {
            $sql.= $this->update($table,$set,$condition);
        }
        $this->dbConnect();
        $statement = $this->_connexion->prepare($sql);
        $statement->execute();
        $this->_connexion = null;
    }

}

?>