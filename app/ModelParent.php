<?php


abstract class ModelParent
{

    //infos de connexion à la bdd
    private string $host = "127.0.0.1:3308";
    private string $dbname = "record";
    private string $user = "root";
    private string $mdp = "1234";
    private string $charset = "utf8";

    //connexion à la bdd en protégé pour être utilisé par éléments enfants
    protected $dbRecord;

    public string $table;
    public string $id;


    /**
     * recuperer connexion bdd
     */
    public function getConnexion()
    {
        $this->dbRecord=null;
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
            $requete = $this->dbRecord->prepare('SELECT * FROM record.' . $this->table);
            $requete->execute();
            return $requete->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $message) {
            echo $message->getCode() . "<br>";
            echo $message->getMessage();
            die;
        }
    }


    /**
     * récupère les détails d'un élément de la base de donnée
     *
     * @return mixed
     */
    public function getOne(string $id)
    {
        try {
            $this->id = $id;
//            $this->id=$id;??
            $requete = $this->dbRecord->prepare('SELECT * FROM record.' . $this->table . ' 
            INNER JOIN record.artist ON disc.artist_id=artist.artist_id WHERE ' .$this->table.".". $this->table . '_id=:id');
//            $requete = $this->dbRecord->prepare('SELECT * FROM  record.disc WHERE disc_id = :id');
//var_dump($id);
            $requete->bindValue(':id', $this->id, PDO::PARAM_INT);
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