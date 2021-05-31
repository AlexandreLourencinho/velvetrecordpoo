<?php


class Crud_artist
{

    // instanciation d'objet base de donnée
    private $db;

    //construction de l'objet base de donnée pour ce crud : sera appelé a chaque fois
    function __construct($connection)
    {
        $this->db = $connection->getDbRecord();
    }

    /**
     * avoir tous les artistes pour le menu déroulant
     * @return mixed
     */
    public function getArtists()
    {
        // requête permettant d'avoir le nom et l'id des artistes dans la bdd, spécifiquement pour les menus déroulant
        $requete = $this->db->query('SELECT artist_name,artist_id FROM record.artist');
        $resultat = $requete->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
    }


}