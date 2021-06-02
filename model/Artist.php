<?php


class Artist extends ModelParent
{
    public function __construct(){
        //définie la table sur disc
        $this->table="artist";
        //recupère la connexion via modelparent et la fonction getConnexion
        $this->getConnexion();
    }

    /**
     * fonction jointure avec able artiste
     * @return mixed
     */
    public function listeArtiste(){
        $requete = $this->dbRecord->query('SELECT * FROM record.'.$this->table);
        return $requete->fetchAll(PDO::FETCH_OBJ);
    }

}