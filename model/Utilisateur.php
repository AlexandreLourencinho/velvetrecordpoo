<?php


class Utilisateur extends ModelParent
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
        $requete->bindValue(':nom', $_POST['nom_compte'], PDO::PARAM_STR);
        $requete->bindValue(':mdp', $_POST['mdp_compte'], PDO::PARAM_STR);
        $requete->bindValue(':mail', $_POST['mail_compte'], PDO::PARAM_STR);
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
        $requete = $this->dbRecord->prepare('DELETE FROM record.utilisateurs WHERE utilisateur_id=:id');
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
    public function tokenMdp($time)
    {
        $requete = $this->dbRecord->prepare('UPDATE record.utilisateurs SET utilisateurs.token_recup=:token WHERE utilisateurs.mail_utilisateur=:mail ');
        $requete->bindValue(':mail', $_POST['mail_compte'], PDO::PARAM_STR);
        $requete->bindValue(':token', $time, PDO::PARAM_STR);
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
    public function chercherMail()
    {
        $requete = $this->dbRecord->prepare('SELECT COUNT(*) as mailbdd FROM record.utilisateurs WHERE utilisateurs.mail_utilisateur=:mail');
        $requete->bindValue(':mail', $_POST['mail_compte'], PDO::PARAM_STR);
        $requete->execute();
        return $resultat = $requete->fetch(PDO::FETCH_OBJ);
    }

    /**
     * vérification si mail existe déjà en bdd
     * @return mixed
     */
    public function chercherNom()
    {
        $requete = $this->dbRecord->prepare('SELECT COUNT(*) as nombdd FROM record.utilisateurs WHERE utilisateurs.nom_utilisateur=:nom');
        $requete->bindValue(':nom', $_POST['nom_compte'], PDO::PARAM_STR);
        $requete->execute();
        return $resultat = $requete->fetch(PDO::FETCH_OBJ);

    }


    /**
     * si retourne un résultat autre que false, utilisateur existe => démarrage session
     * @return mixed
     */
    public function connexionUtilisateur()
    {
        $requete = $this->dbRecord->prepare('SELECT utilisateurs.mdp_utilisateur as mdp FROM record.utilisateurs WHERE utilisateurs.nom_utilisateur=:nom AND utilisateurs.mail_utilisateur=:mail');
        $requete->bindValue(':nom', $_POST['nom_compte'], PDO::PARAM_STR);
        $requete->bindValue(':mail', $_POST['mail_compte'], PDO::PARAM_STR);
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_OBJ);
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
        $requete->bindValue(':mdp', $_POST['mdp_compte'], PDO::PARAM_STR);
        $requete->bindValue(':token', $token, PDO::PARAM_STR);
        if ($requete->execute()) {
            return array('resultat' => true, 'message' => 'réussite');
        } else {
            return array('resultat' => false, 'message' => 'échec');
        }
    }


    public function tokenUtilisateur($token)
    {
        $requete = $this->dbRecord->prepare('SELECT COUNT(*) as tokenrecup FROM record.utilisateurs WHERE utilisateurs.token_recup=:token');
        $requete->bindValue(':token', $token, PDO::PARAM_INT);
        $requete->execute();
        return $resultat = $requete->fetch(PDO::FETCH_OBJ);
    }



    public function supprimerToken($token){
        $requete = $this->dbRecord->prepare('UPDATE record.utilisateurs SET utilisateurs.token_recup=NULL WHERE utilisateurs.token_recup=:token');
        $requete->bindValue(':token',$token,PDO::PARAM_STR);
        if($requete->execute()){
            return array('resultat'=>true,'message'=>'réussite');
        }
        else{
            return array('resultat'=>false,'message'=>'échec');
        }

    }


}