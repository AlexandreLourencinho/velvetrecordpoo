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

    public function ajoutUtilisateur(){
        $requete = $this->dbRecord->prepare('INSERT INTO record.utilisateurs(nom_utilisateur, mdp_utilisateur, mail_utilisateur) VALUES (:nom,:mdp,:mail)');
        $requete->bindValue(':',$_POST[''],PDO::PARAM_STR);
        $requete->bindValue(':',$_POST[''],PDO::PARAM_STR);
        $requete->bindValue(':',$_POST[''],PDO::PARAM_STR);
        if($requete->execute()){
            return array('resultat'=>true,'message'=>'réussite');
        }
        else{
            return array('resultat'=>false,'message'=>'échec');
        }
    }


    public function supprimerUtilisateur($id){
        $requete = $this->dbRecord->prepare('DELETE FROM record.utilisateurs WHERE id_utilisateur=:id');
        $requete->bindValue(':id',$id,PDO::PARAM_INT);
        if($requete->execute()){
            return array('resultat'=>true,'message'=>'réussite');
        }
        else{
            return array('resultat'=>false,'message'=>'échec');
        }
    }


    public function tokenMdp($id){
        $requete = $this->dbRecord->prepare('UPDATE record.utilisateurs SET utilisateurs.token_recup=:token WHERE utilisateurs.nom_utilisateur=:nom ');
        $requete->bindValue(':mail',$_POST[''],PDO::PARAM_STR);
        $requete->bindValue(':token',$_POST[''],PDO::PARAM_STR);
        if($requete->execute()){
            return array('resultat'=>true,'message'=>'réussite');
        }
        else{
            return array('resultat'=>false,'message'=>'échec');
        }

    }


    public function chercherNomOuMailUtilisateur(){
        $requete = $this->dbRecord->prepare('SELECT * FROM record.utilisateurs WHERE utilisateurs.mail_utilisateur=:mail OR utilisateurs.nom_utilisateur');
        $requete->bindValue(':mail',$_POST[''],PDO::PARAM_STR);
        $requete->bindValue(':nom',$_POST[''],PDO::PARAM_STR);
        $resultat=$requete->execute();
        return $resultat;
    }

    public function chercherMailUtilisateur(){

    }


    public function connexionUtilisateur(){
        $requete=$this->dbRecord->prepare('SELECT * FROM record.utilisateurs WHERE utilisateurs.nom_utilisateur=:nom AND utilisateurs.mdp_utilisateur=:mdp');
        $requete->bindValue(':nom',$_POST[''],PDO::PARAM_STR);
        $requete->bindValue(':mdp',$_POST[''],PDO::PARAM_STR);
        $resultat=$requete->execute();
        return $resultat;

    }


}