<?php


class Utilisateurs extends AbstractController
{
    /**
     *
     */
    public function formulaire_connexion()
    {
        $aff = false;
        if(isset($_SESSION) and isset($_SESSION['nom']) AND $aff===false){
            header('location: /disques/listeDisques');
        }
        if (isset($_SESSION['nom'])) {
            header('location: /disques/listeDisques');
        }

//        $modelutilisateur = $this->chargerModel('utilisateur');
        if (!isset($_POST['envoi'])) {
            $this->afficher('se_connecter', [
                'aff' => $aff
            ]);
        } elseif (isset($_POST['envoi'])) {
            $utilisateurs = $this->chargerModel('Utilisateur');
            $resultatconnexion = $utilisateurs->connexionUtilisateur();

            if ($resultatconnexion === false) {
                $this->afficher('se_connecter', [
                    'message' => 'Le nom de compte, le mail ou le mot de passe sont incorrect(s). Si vous avez oublié votre mot de passe,
                    vous pouvez utiliser le lien "mot de passe oublié?" . Si vous n\'avez pas de compte, n\'hésitez pas à en créer un!',
                    'aff' => $aff
                ]);
            } elseif (password_verify($_POST['mdp_compte'], $resultatconnexion->mdp)) {
                $aff = true;
                $_SESSION['nom'] = $_POST['nom_compte'];
                $this->afficher('se_connecter', [
                    'aff' => $aff
                ]);
            }
        }
    }

    /**
     *
     */
    public function recup_mdp()
    {
        $aff=false;
        if (!isset($_POST['envoi'])) {
            $this->afficher('mdp_oublie', ['aff'=>$aff]);
        } elseif (isset($_POST['envoi'])) {
            $utilisateurs = $this->chargerModel('Utilisateur');
            $resultatmail = $utilisateurs->chercherMail();
//            var_dump($resultatmail);
            if ($resultatmail->mailbdd == 0) {
                $this->afficher('mdp_oublie', [
                    'message' => 'Le compte associé à cette adresse éléctronique n\'a pas été trouvée.',
                    'aff'=>$aff
                ]);
            } elseif ($resultatmail->mailbdd == 1) {
                $date = new DateTime();
                $time = $date->getTimestamp();
                $token = $utilisateurs->tokenMdp($time);
                if ($token['resultat'] === true) {
                    mail($_POST['mail_compte'], "récupération de mdp", "utilisez ce lien: http://localhost:8005/utilisateurs/changerMdp/" . $time,
                        array('From' => 'velvet@record.fr', 'Reply-To' => 'mail@placeholder.fr', 'X-Mailer' => 'PHP/' . phpversion()));
                    $aff=true;
                    $this->afficher('mdp_oublie',[
                        'aff'=>$aff
                    ]);
                }
            }
        }
    }

    /**
     *
     */
    public function creer_compte()
    {
        if (isset($_SESSION['nom'])) {
            header('location: /disques/listeDisques');
        }
        $aff = false;
        if (!isset($_POST['envoi'])) {
            $this->afficher('inscription', [
                'aff' => $aff
            ]);
        } elseif (isset($_POST['envoi'])) {

            $utilisateurs = $this->chargerModel('Utilisateur');

            $formulaire = $this->chargerFonction('checkForm');
            unset($_POST['envoi']);
            $resultatform = $formulaire->checkFormUser();
//        var_dump($resultatform);
            $cherchernom = $utilisateurs->chercherNom();
//            var_dump($cherchernom);
            $cherchermail = $utilisateurs->chercherMail();
//            var_dump($cherchermail);
            if ($cherchernom->nombdd != 0) {
                $resultatform['nom_compte'] = 'ce nom d\'utilisateur existe déjà. Veuillez en choisir un autre.
                Si vous avez oublié votre mot de passe, utilisez le lien "mot de passe oublié?".';
                $this->afficher('inscription', [
                    'erreurs' => $resultatform,
                    'aff' => $aff
                ]);
            }
            if ($cherchermail->mailbdd != 0) {
                $resultatform['mail_compte'] = 'Cette adresse électronique est déjà utilisée. Veuillez en utiliser une autre.
                Si vous avez oublié votre mot de passe, utilisez le lien "mot de passe oublié?".';
                $this->afficher('inscription', [
                    'erreurs' => $resultatform,
                    'aff' => $aff
                ]);
            }
            if (count($resultatform) != 0) {
                $this->afficher('inscription', [
                    'erreurs' => $resultatform,
                    'aff' => $aff
                ]);
            } elseif (count($resultatform) == 0) {
                $_POST['mdp_compte'] = password_hash($_POST['mdp_compte'], PASSWORD_DEFAULT);
                $ajoutcompte = $utilisateurs->ajoutUtilisateur();
                var_dump($ajoutcompte);
                if ($ajoutcompte['resultat'] === true) {
                    $aff = true;
                    unset($_POST);
                    $this->afficher('inscription', [
                        'aff' => $aff
                    ]);
                }
            }
        }
    }

    /**
     *
     */
    public function se_deconnecter()
    {
        if (!isset($_SESSION['nom'])) {
            header('location: /disques/listeDisques');
        }
        $this->afficher('se_deconnecter', []);
    }



    public function changerMdp($token=null){
        if(!isset($token)){
            $this->afficher('changer_mdp',[
                'token'=>$token,
                'message'=>'lien expiré'
            ]);
        }
        elseif(isset($token)){
            $this->afficher('changer_mdp',[
                'token'=>$token
            ]);
        }
        elseif(isset($token) AND isset($_POST['envoi'])){

        }
    }


}