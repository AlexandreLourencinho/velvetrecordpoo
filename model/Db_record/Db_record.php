<?php


class Db_record
{

    // variables privées qui serviront a construire la connexion
    private $host = "localhost:3308";
    private $dbname = "record";
    private $charset = "UTF8";
    private $user = "root";
    private $mdp = "1234";
    private $dbRecord;

    function __construct()
    {
        // définition du dsn puis
        $dsn = "mysql:host=$this->host,dbname=$this->dbname,charset=$this->charset";
        try {
            // création de la connexion à la BDD avec les info données ci dessus. le $this signifie qu'on utilise les données
            // de l'objet dans lequel on est, à savoir la classe db_records ici
            $this->dbRecord = new PDO($dsn, $this->user, $this->mdp);
            //définit les modes d'erreur
            $this->dbRecord->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            echo "Hello database!";

        } catch
        (PDOException $message) {
            // attribue les erreurs de co a la variable message qui est ensuite echo
            $message->getMessage();
            echo $message . "<br>";
            $message->getCode();
            echo $message;
            die();

        }
    }

    /**
     * fonction connexion base de donnée
     * @return PDO
     */
    public function getDbRecord()
    {
        // permet de retourner la connexion qui a été effectuée au dessus afin qu'elle soit utilisée hors de la classe
        // c'est ce qui est retourné quand on l'appelle avec le $conn = new db_records(); pour créer une nouvelle connexion à la bdd
        // note : selon germain, une fois utilisée, cette connexion est "tuée" automatiquement pas besoin d'un __destruct()
        return $this->dbRecord;
    }
}