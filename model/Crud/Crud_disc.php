<?php


class Crud_disc
{
    // instanciation d'objet base de donnée
    private $db;

    //construction de l'objet base de donnée pour ce crud : sera appelé a chaque fois
    function __construct($connection)
    {
        $this->db = $connection->getDbRecord();
    }


    /**
     * fonction listing tous les disques
     * @return Exception
     */
    public function read_all_records()
    {

        try {
            //requête de selection de tout des deux tables,retourne un tableau d'objet
            $requete = $this->db->query("SELECT * FROM record.disc INNER JOIN record.artist ON disc.artist_id=artist.artist_id");
            $resultat = $requete->fetchAll(PDO::FETCH_OBJ);
            return $resultat;

        } catch (Exception $message) {
            // en cas d'erreur la variable message est initialisée via le Exception, ci dessous on récupère
            // le message et le code d'erreur qu'on retourne ensuite
            echo $message->getMessage() . "<br>";
            echo $message->getCode() . "<br>";
            return $message;
        }
    }

    /**
     * fonction qui donne le nombre des diques pour l'affichage sur la page de liste
     * @return mixed
     */
    public function nbDisques()
    {
        // juste la fonction qui permet l'affichage du nombre de disques présent dans la BDD
        $requete = $this->db->query("SELECT COUNT(*) FROM record.disc");
        $resultat = $requete->fetch();
        return $resultat;
    }

    /**
     * fonction qui donne le détail d'un disque pour la page details_disques.php
     * @return mixed
     */
    public function getRecord()
    {
        // Fonction - requête qui permet de récupérer tous les détails d'un seul disque
        $requete = $this->db->prepare('SELECT * FROM record.disc INNER JOIN record.artist ON disc.artist_id=artist.artist_id WHERE disc.disc_id=:disc_id');
        // récupère l'id par la voie get ou post
        if (isset($_POST['disc_id'])) {
            $idart = $_POST['disc_id'];
        } else {
            $idart = $_GET['disc_id'];
        }
        // liaison du paramètre id à l'id du disque, puis execution de la requête
        $requete->bindValue(":disc_id", $idart, PDO::PARAM_INT);
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_OBJ);
        return $resultat;
    }

    /**
     *fonction pour l'ajout de disque dans la base de donénes
     * @return array
     */
    public function ajouterDisque($titre, $annee, $image, $label, $genre, $prix, $artiste)
    {
        try {
            // fonction qui va ajouter un disque a la BDD. prepare pour préparer la requete, ensuite la liaison
            // des paramètres.
            $requete = $this->db->prepare("INSERT INTO record.disc(disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, artist_id) 
                                            VALUES (:titre, :annee, :image, :label, :genre, :prix, :artiste)");
            $requete->bindValue(":titre", $titre, PDO::PARAM_STR);
            $requete->bindValue(":annee", $annee, PDO::PARAM_INT);
            $requete->bindValue(":label", $label, PDO::PARAM_STR);
            $requete->bindValue(":artiste", $artiste, PDO::PARAM_INT);
            $requete->bindValue(":genre", $genre, PDO::PARAM_STR);
            $requete->bindValue(":prix", $prix, PDO::PARAM_STR);
            $requete->bindValue(":image", $image, PDO::PARAM_STR);
            // retourne vrai ou faux + un message si la requête s'est correctement executée ou pas(dans un tableau)
            if ($requete->execute()) {
                return array('resultat' => true, 'message' => 'insertion réussie');
            } else {
                return array('resultat' => false, 'message' => 'insertion échouée');
            }
        } catch (Exception $message) {
            $message->getMessage();
            $message->getCode();
            return array('resultat' => false, 'message' => $message);
        }
    }

    /**
     * fonction de suppression de disque
     * @param $disc_id
     * @return array
     */
    public function supprimerDisque($disc_id)
    {
        try {
            // fonction qui va supprimer un disque. même méthode; on prépare, on lie, et si la requête s'execute,
            // retour de true ou false
            $requete = $this->db->prepare('DELETE FROM record.disc WHERE disc_id=:disc_id');
            $requete->bindValue(":disc_id", $disc_id, PDO::PARAM_INT);
            if ($requete->execute()) {
                return array('resultat' => true, 'message' => 'Suppression réussie');
            } else {
                return array('resultat' => false, 'message' => 'Suppression échouée');
            }

        } catch (Exception $message) {
            $message->getMessage();
            $message->getCode();
            return array('resultat' => false, 'message' => $message);
        }

    }

    /**
     * fonction de modification d'un dique
     * @param $titre
     * @param $annee
     * @param $label
     * @param $genre
     * @param $prix
     * @param $artiste
     * @param $id
     * @return array
     */
    public function modifierDisque($titre, $annee, $label, $genre, $prix, $artiste, $id)
    {
        try {
            // requête qui va modifier un disque dans la BDD. l'image est gérée dans une requête à part
            $requete = $this->db->prepare('UPDATE record.disc SET disc_title=:titre, disc_year = :annee, disc_label = :label, 
                       disc_genre = :genre,disc_price = :prix, artist_id = :artiste WHERE disc_id=:disc_id');
            $requete->bindValue(':titre', $titre, PDO::PARAM_STR);
            $requete->bindValue(':annee', $annee, PDO::PARAM_INT);
            $requete->bindValue(':label', $label, PDO::PARAM_STR);
            $requete->bindValue(':genre', $genre, PDO::PARAM_STR);
            $requete->bindValue(':prix', $prix, PDO::PARAM_STR);
            $requete->bindValue(':disc_id', $id, PDO::PARAM_INT);
            $requete->bindValue(':artiste', $artiste, PDO::PARAM_INT);

            if ($requete->execute()) {
                return array('resultat' => true, 'message' => 'Modification réussie');
            } else {
                return array('resultat' => false, 'message' => 'Echec de la modification');
            }

        } catch (Exception $message) {
            $message->getMessage();
            $message->getCode();
            return array('resultat' => false, 'message' => $message);
        }
    }

    /**
     * fonction de modification de l'image d'illustration d'un disque
     * @param $image
     * @param $id
     * @return array
     */
    public function modifImage($image, $id)
    {
        try {
            // requête qui sert spécifiquement a modifier l'image, de telle sorte qu'on puisse modifier un disque sans avoir
            // obligatoirement a modifier l'image et sans remplacer le disc_picture par null
            $requete = $this->db->prepare('UPDATE record.disc SET disc_picture=:image WHERE disc_id=:disc_id');
            $requete->bindValue(":image", $image, PDO::PARAM_STR);
            $requete->bindValue(":disc_id", $id, PDO::PARAM_INT);
            if ($requete->execute()) {
                return array('resultat' => true, 'message' => "insertion de l'image réussie");
            } else {
                return array('resultat' => false, 'message' => "Echec de la modification de l'image");
            }

        } catch (Exception $message) {
            $message->getCode();
            $message->getMessage();
            return array('resultat' => false, 'message' => $message);
        }
    }

}