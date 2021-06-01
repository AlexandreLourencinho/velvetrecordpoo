<?php


class Disc extends ModelParent
{
    public function __construct(){
        //définie la table sur disc
        $this->table="disc";
        //recupère la connexion via modelparent et la fonction getConnexion
        $this->getConnexion();
    }


    /**
     * fonction jointure avec able artiste
     * @return mixed
     */
    public function disqueParArtiste(){
        $requete = $this->dbRecord->query('SELECT * FROM record.'.$this->table.' INNER JOIN record.artist ON '. $this->table.'.artist_id=artist.artist_id');
        return $requete->fetchAll(PDO::FETCH_OBJ);
    }



}