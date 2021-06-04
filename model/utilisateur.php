<?php


class utilisateur extends ModelParent
{

    /**
     * utilisateur constructor.
     */
    public function __construct()
    {
        //définie la table sur disc
        $this->table = "utilisateurs";
        //recupère la connexion via modelparent et la fonction getConnexion
        $this->getConnexion();
    }

    /**
     * creation de compte utilisateur
     * @return array
     */
    public function ajoutUtilisateur()
    {
        $requete = $this->dbRecord->prepare('INSERT INTO record.utilisateurs(nom_utilisateur, mdp_utilisateur, mail_utilisateur) VALUES (:nom,:mdp,:mail)');
        $requete->bindValue(':', $_POST[''], PDO::PARAM_STR);
        $requete->bindValue(':', $_POST[''], PDO::PARAM_STR);
        $requete->bindValue(':', $_POST[''], PDO::PARAM_STR);
        if ($requete->execute()) {
            return array('resultat' => true, 'message' => 'réussite');
        } else {
            return array('resultat' => false, 'message' => 'échec');
        }
    }

    /**
     * suppression d'un utilisateur
     * @param $id
     * @return array
     */
    public function supprimerUtilisateur($id)
    {
        $requete = $this->dbRecord->prepare('DELETE FROM record.utilisateurs WHERE id_utilisateur=:id');
        $requete->bindValue(':id', $id, PDO::PARAM_INT);
        if ($requete->execute()) {
            return array('resultat' => true, 'message' => 'réussite');
        } else {
            return array('resultat' => false, 'message' => 'échec');
        }
    }

    /**
     * ajout du token timestamp en bdd
     * @return array
     */
    public function tokenMdp()
    {
        $requete = $this->dbRecord->prepare('UPDATE record.utilisateurs SET utilisateurs.token_recup=:token WHERE utilisateurs.nom_utilisateur=:nom ');
        $requete->bindValue(':mail', $_POST[''], PDO::PARAM_STR);
        $requete->bindValue(':token', $_POST[''], PDO::PARAM_STR);
        if ($requete->execute()) {
            return array('resultat' => true, 'message' => 'réussite');
        } else {
            return array('resultat' => false, 'message' => 'échec');
        }

    }

    /**
     * verification si nom exite déjà en bdd
     * @return mixed
     */
    public function chercherNom()
    {
        $requete = $this->dbRecord->prepare('SELECT * FROM record.utilisateurs WHERE utilisateurs.mail_utilisateur=:mail');
        $requete->bindValue(':nom', $_POST[''], PDO::PARAM_STR);
        $resultat = $requete->execute();
        return $resultat;
    }

    /**
     * vérification si mail existe déjà en bdd
     * @return mixed
     */
    public function chercherMail()
    {
        $requete = $this->dbRecord->prepare('SELECT * FROM record.utilisateurs WHERE utilisateurs.mail_utilisateur=:mail');
        $requete->bindValue(':mail', $_POST[''], PDO::PARAM_STR);
        $resultat = $requete->execute();
        return $resultat;

    }


    /**
     * si retourne un résultat autre que false, utilisateur existe => démarrage session
     * @return mixed
     */
    public function connexionUtilisateur()
    {
        $requete = $this->dbRecord->prepare('SELECT * FROM record.utilisateurs WHERE utilisateurs.nom_utilisateur=:nom AND utilisateurs.mdp_utilisateur=:mdp');
        $requete->bindValue(':nom', $_POST[''], PDO::PARAM_STR);
        $requete->bindValue(':mdp', $_POST[''], PDO::PARAM_STR);
        $resultat = $requete->execute();
        return $resultat;

    }


    /**
     * fonction qui permet de changer le mdp => passer le token en paramètre
     * @param $token
     * @return array
     */
    public function changerMdp($token)
    {
        $requete = $this->dbRecord->prepare('UPDATE record.utilisateurs SET utilisateurs.mdp_utilisateur=:mdp WHERE utilisateurs.token_recup=:token');
        $requete->bindValue(':mdp', $_POST[''], PDO::PARAM_STR);
        $requete->bindValue(':token', $token, PDO::PARAM_STR);
        if ($requete->execute()) {
            return array('resultat' => true, 'message' => 'réussite');
        } else {
            return array('resultat' => false, 'message' => 'échec');
        }
    }


}