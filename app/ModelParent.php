<?php


abstract class ModelParent
{
    private $host = "127.0.0.1:3308";
    private $dbname = "record";
    private $user = "root";
    private $mdp = "1234";
    private $charset = "utf8";
    private $dbRecord;


    /**
     * recuperer connexion bdd
     */
    public function getConnexion()
    {
        try {
            $dsn = "mysql:host=$this->host,dbname=$this->dbname,charset=$this->charset";
            $this->dbRecord = new PDO($dsn, $this->user, $this->mdp);
            $this->dbRecord->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $message) {
            echo $message->getMessage() . "<br>";
            echo $message->getCode();
            die;
        }
    }

    /**
     * selectionner tout depuis une table : servira a classe fille
     * @return mixed
     */
    public function getAll()
    {
        try {
            $requete = $this->dbRecord->query('SELECT * FROM' . $this->table);
            return $requete->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $message) {
            echo $message->getCode() . "<br>";
            echo $message->getMessage();
            die;
        }
    }


    /**
     * récupère les détails d'un élément de la base de donnée
     * @param int $id
     * @return mixed
     */
    public function getOne(int $id)
    {
        try {
//            $this->id=$id;??
            $requete = $this->dbRecord->prepare('SELECT * FROM' . $this->table . 'WHERE ' . $this->table . '_id = :id');
            $requete->bindValue(':id', $id, PDO::PARAM_INT);
            $requete->execute();
            $resultat = $requete->fetch(PDO::FETCH_OBJ);
            return $resultat;

        } catch (Exception $message) {
            echo $message->getCode() . "<br>";
            echo $message->getMessage();
            die;
        }
    }


}