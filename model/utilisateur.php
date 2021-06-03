<?php


class utilisateur extends ModelParent
{


    public function __construct()
    {
        //définie la table sur disc
        $this->table = "utilisateurs";
        //recupère la connexion via modelparent et la fonction getConnexion
        $this->getConnexion();
    }

    /**
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
     * @param $token
     * @return array
     */
    public function changerMdp($token){
        $requete = $this->dbRecord->prepare('UPDATE record.utilisateurs SET utilisateurs.mdp_utilisateur=:mdp WHERE utilisateurs.token_recup=:token');
        $requete->bindValue(':mdp',$_POST[''],PDO::PARAM_STR);
        $requete->bindValue(':token',$token,PDO::PARAM_STR);
        if($requete->execute()){
            return array('resultat'=>true,'message'=>'réussite');
        }
        else{
            return array('resultat'=>false,'message'=>'échec');
        }
    }


}