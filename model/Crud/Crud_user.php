<?php


class Crud_user
{
    // instanciation d'objet base de donnée
    private $db;
    /**
     * crud_user constructor.
     * @param $conn
     */
    //construction de l'objet base de donnée pour ce crud : sera appelé a chaque fois
    function __construct($conn)
    {
        $this->db = $conn->getDbRecord();
    }

    /**
     * Fonction de création de compte utilisateur
     * @param $nom
     * @param $mdp
     * @param $mail
     */
    public function createUser($nom, $mdp, $mail)
    {

        $requete = $this->db->prepare("INSERT INTO record.utilisateurs(Nom_utilisateur, mdp_utilisateur, mail_utilisateur) VALUES(:nom,:mdp,:mail)");
        $requete->bindValue(":nom", $nom, PDO::PARAM_STR);
        $requete->bindValue(":mdp", $mdp, PDO::PARAM_STR);
        $requete->bindValue(":mail", $mail, PDO::PARAM_STR);
        $requete->execute();

    }

    /**
     * fonction qui recherche si le nom de compte est deja enregistré quelquepart en bdd
     * @param $nom
     * @return mixed
     */
    public function rechercheNom($nom)
    {
        $requete = $this->db->prepare("SELECT COUNT(*) FROM record.utilisateurs WHERE Nom_utilisateur=:nom");
        $requete->bindValue(':nom', $nom, PDO::PARAM_STR);
        $requete->execute();
        $resultat = $requete->fetch();
        return $resultat;
    }

    /**
     * fonction qui regarde si le mail est djà enregistré quelquepart en bdd
     * @param $mail
     * @return mixed
     */
    public function rechercheMail($mail)
    {
        $requete = $this->db->prepare("SELECT COUNT(*) FROM record.utilisateurs WHERE mail_utilisateur=:mail");
        $requete->bindValue(":mail", $mail, PDO::PARAM_STR);
        $requete->execute();
        $resultat = $requete->fetch();
        return $resultat;
    }

    /**
     * fonction de recherche d'utilisateur par adresse mail pour le mdp perdu
     * @param $mail
     * @return mixed
     */
    public function rechercheMailMdpPerdu($mail)
    {
        $requete = $this->db->prepare("SELECT utilisateurs.mail_utilisateur FROM record.utilisateurs WHERE mail_utilisateur=:mail");
        $requete->bindValue(":mail", $mail, PDO::PARAM_STR);
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_OBJ);
        return $resultat;
    }

    /**
     * récupère les infos via le nom de compte utilisateur
     * @param $nom
     * @return array
     */
    public function rechercheUtilisateurs($nom)
    {
        $requete = $this->db->prepare("SELECT * FROM record.utilisateurs WHERE nom_utilisateur=:nom");
        $requete->bindValue(':nom', $nom, PDO::PARAM_STR);
        if ($requete->execute()) {
            $resultat = $requete->fetch(PDO::FETCH_OBJ);
            return $resultat;
        } else {
            return array('resultat' => false, 'message' => 'nom d\'utilisateur ou mot de passe incorrect');
        }
    }

    /**
     * inscrit le token en bdd pour la recup de mdp
     * @param $token
     * @param $mail
     * @return array
     */
    public function tokenMdp($token, $mail)
    {
        $requete = $this->db->prepare("UPDATE record.utilisateurs SET token_recup=:token WHERE utilisateurs.mail_utilisateur=:mail");
        $requete->bindValue(':token', $token, PDO::PARAM_INT);
        $requete->bindValue(':mail', $mail, PDO::PARAM_STR);
        if ($requete->execute()) {
            return array('resultat' => true, 'message' => 'réussite');
        } else {
            return array('resultat' => false, 'message' => 'echec');
        }

    }


    /**
     * recup le compte où le token est stocké
     * @param $token
     * @return array
     */
    public function recupMdp($token)
    {
        $requete = $this->db->prepare("SELECT * FROM record.utilisateurs WHERE token_recup=:token");
        $requete->bindValue(":token", $token, PDO::PARAM_INT);
        if ($requete->execute()) {
            return $resultat = $requete->fetch(PDO::FETCH_OBJ);
        } else {
            return array('resultat' => false, 'message' => 'echec');
        }

    }


    /**
     * change le mdp
     * @param $token
     * @param $mdp
     * @return array
     */
    public function changeMdp($token, $mdp)
    {
        $requete = $this->db->prepare("UPDATE record.utilisateurs SET utilisateurs.mdp_utilisateur=:mdp WHERE utilisateurs.token_recup=:token");
        $requete->bindValue(':mdp', $mdp, PDO::PARAM_STR);
        $requete->bindValue(':token', $token, PDO::PARAM_INT);
        if ($requete->execute()) {
            return array('resultat' => true, 'message' => 'reussite');
        } else {
            return array('resultat' => false, 'message' => 'echec');
        }

    }
}