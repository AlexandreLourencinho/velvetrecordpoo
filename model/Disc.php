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

    public function compterDisque(){
        $requete=$this->dbRecord->query('SELECT COUNT(*) as compteur FROM record.'.$this->table);
        return $requete->fetch(PDO::FETCH_OBJ);
    }

    public function ajouterDisque(){
        $requete=$this->dbRecord->prepare('INSERT INTO record.disc(disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, artist_id) VALUES (:titre, :annee, :image, :label, :genre, :prix, :artiste)');
        $requete->bindValue(':titre',$_POST['titre'],PDO::PARAM_STR);
        $requete->bindValue(':annee',$_POST['annee'],PDO::PARAM_INT);
        $requete->bindValue(':image',$_POST['image'],PDO::PARAM_STR);
        $requete->bindValue(':label',$_POST['label'],PDO::PARAM_STR);
        $requete->bindValue(':genre',$_POST['genre'],PDO::PARAM_STR);
        $requete->bindValue(':prix',$_POST['prix'],PDO::PARAM_STR);
        $requete->bindValue(':artiste',$_POST['artiste'],PDO::PARAM_STR);
        if($requete->execute()){
            return array('resultat'=>true,'message'=>'réussite');
        }
        else{
            return array('resultat'=>false,'message'=>'échec');
        }
    }


}