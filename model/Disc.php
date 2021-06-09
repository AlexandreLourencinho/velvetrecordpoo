<?php


class Disc extends ModelParent
{
    public function __construct()
    {
        //définie la table sur disc
        $this->table = "disc";
        //recupère la connexion via modelparent et la fonction getConnexion
        $this->getConnexion();
    }


    /**
     * fonction jointure avec able artiste
     * @return mixed
     */
    public function disqueParArtiste()
    {
        $requete = $this->dbRecord->query('SELECT * FROM record.' . $this->table . ' INNER JOIN record.artist ON ' . $this->table . '.artist_id=artist.artist_id');
        return $requete->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * fonction qui retourne le nombre de disques dans la bdd
     * @return mixed
     */
    public function compterDisque()
    {
        $requete = $this->dbRecord->query('SELECT COUNT(*) as compteur FROM record.' . $this->table);
        return $requete->fetch(PDO::FETCH_OBJ);
    }

    /**
     * fonction qui ajoute un disque dans la bdd
     * @return array
     */
    public function ajouterDisque()
    {
        $requete = $this->dbRecord->prepare('INSERT INTO record.disc(disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, artist_id) VALUES (:titre, :annee, :image, :label, :genre, :prix, :artiste)');
        $requete->bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
        $requete->bindValue(':annee', $_POST['annee'], PDO::PARAM_INT);
        $requete->bindValue(':image', $_POST['image'], PDO::PARAM_STR);
        $requete->bindValue(':label', $_POST['label'], PDO::PARAM_STR);
        $requete->bindValue(':genre', $_POST['genre'], PDO::PARAM_STR);
        $requete->bindValue(':prix', $_POST['prix'], PDO::PARAM_STR);
        $requete->bindValue(':artiste', $_POST['artiste'], PDO::PARAM_STR);
        if ($requete->execute()) {
            return array('resultat' => true, 'message' => 'réussite');
        } else {
            return array('resultat' => false, 'message' => 'échec');
        }
    }

    /**
     * fonction qui modifie un disque en bdd (sauf image)
     * @param $id
     * @return array
     */
    public function modifDisque($id)
    {
        $requete = $this->dbRecord->prepare('UPDATE record.disc SET disc_title=:titre, disc_year = :annee, disc_label=:label, disc_genre=:genre, disc_price=:prix, artist_id=:artiste WHERE disc_id=:id');
        $requete->bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
        $requete->bindValue(':artiste', $_POST['artiste'], PDO::PARAM_STR);
        $requete->bindValue(':annee', $_POST['annee'], PDO::PARAM_INT);
        $requete->bindValue(':label', $_POST['label'], PDO::PARAM_STR);
        $requete->bindValue(':genre', $_POST['genre'], PDO::PARAM_STR);
        $requete->bindValue(':prix', $_POST['prix'], PDO::PARAM_STR);
        $requete->bindValue(':id', $id, PDO::PARAM_INT);
        if ($requete->execute()) {
            return array('resultat' => true, 'message' => 'réussite');
        } else {
            return array('resultat' => false, 'message' => 'échec');
        }
    }

    /**
     * fonction qui modifie l'image en bdd
     * @param $id
     * @return array
     */
    public function modifImage($id)
    {
        $requete = $this->dbRecord->prepare('UPDATE record.disc SET disc_picture=:image WHERE disc_id=:id');
        $requete->bindValue(':image', $_POST['image'], PDO::PARAM_STR);
        $requete->bindValue(':id', $id, PDO::PARAM_INT);
        if ($requete->execute()) {
            return array('resultat' => true, 'message' => 'modif image réussie');
        } else {
            return array('resultat' => false, 'message' => 'echec de l\'insertiondu doigt dans le petit');
        }

    }

    /**
     * fonction qui supprime un disque de la bdd
     * @param $id
     * @return array
     */
    public function supprimerDisque($id)
    {
        $requete = $this->dbRecord->prepare('DELETE FROM record.disc WHERE disc_id=:id');
        $requete->bindValue(':id', $id, PDO::PARAM_INT);
        if ($requete->execute()) {
            return array('resultat' => true, 'message' => 'réussite de la suppression');
        } else {
            return array('resultat' => false, 'message' => 'echec de la suppression');
        }
    }


    public function __destruct(){

    }




}