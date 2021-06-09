<?php


class Utilisateurs extends AbstractController
{
    /**
     *
     */
    public function formulaire_connexion()
    {
        $aff = false;
        if (isset($_SESSION) and isset($_SESSION['nom']) and $aff === false) {
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
            else{
                $this->afficher('se_connecter',[
                    'message'=>'le mot de passe est incorrect.',
                    'aff'=>$aff
                ]);
            }
        }
    }

    /**
     *
     */
    public function recup_mdp()
    {
        $aff = false;
        if (!isset($_POST['envoi'])) {
            $this->afficher('mdp_oublie', ['aff' => $aff]);
        } elseif (isset($_POST['envoi'])) {
            $utilisateurs = $this->chargerModel('Utilisateur');
            $resultatmail = $utilisateurs->chercherMail();

            if ($resultatmail->mailbdd == 0) {
                $this->afficher('mdp_oublie', [
                    'message' => 'Le compte associé à cette adresse éléctronique n\'a pas été trouvée.',
                    'aff' => $aff
                ]);
            } elseif ($resultatmail->mailbdd == 1) {
                $date = new DateTime();
                $time = $date->getTimestamp();
                $token = $utilisateurs->tokenMdp($time);
                if ($token['resultat'] === true) {
                    mail($_POST['mail_compte'], "récupération de mdp", "utilisez ce lien: http://localhost:8005/utilisateurs/changerMdp/" . $time,
                        array('From' => 'velvet@record.fr', 'Reply-To' => 'mail@placeholder.fr', 'X-Mailer' => 'PHP/' . phpversion()));
                    $aff = true;
                    $this->afficher('mdp_oublie', [
                        'aff' => $aff
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


    public function changerMdp($tokenrecup = null)
    {
        $aff = false;
        if (!isset($tokenrecup) or $tokenrecup === '') {
            $this->afficher('changer_mdp', [
                'message' => 'lien expiré',
                'aff' => $aff
            ]);

        } elseif (isset($tokenrecup) and !isset($_POST['envoi'])) {
            $this->afficher('changer_mdp', [
                'token' => $tokenrecup,
                'aff' => $aff
            ]);
        } elseif (isset($tokenrecup) and isset($_POST['envoi'])) {
            $token = intval($tokenrecup);
            $utilisateurs = $this->chargerModel('Utilisateur');
            $recherchetoken = $utilisateurs->tokenUtilisateur($tokenrecup);
            if ($recherchetoken->tokenrecup != 1) {
                $this->afficher('changer_mdp', [
                    'message' => 'lien expiré',
                    'aff' => $aff
                ]);
            } elseif ($recherchetoken->tokenrecup == 1) {
                $form = $this->chargerFonction('checkForm');
                $erreurs = $form->checkFormMdp();
                var_dump($erreurs);
                $date = new DateTime();
                $datejour = new DateTime();
                $datetoken = $datejour->setTimestamp($tokenrecup);
                var_dump($date);
                var_dump($datetoken);

                $interval = $date->diff($datetoken, true);
                var_dump($interval);

                //test si lien expiré
                $testminutes = intval($interval->format('%i'));
                $testheures = intval($interval->format('%h'));
                $testjours = intval($interval->format('%d'));
                $testmois = intval($interval->format('%m'));
                $testannee = intval($interval->format('%y'));
                var_dump($testminutes);
                var_dump($testheures);
//                die;
                if ($testminutes >= 15 and $testheures > 1 and $testjours >= 1 and $testmois >= 1 and $testannee >= 1) {
                    $this->afficher('changer_mdp', [
                        'aff' => $aff,
                        'message' => 'lien expiré'
                    ]);
                } elseif (count($erreurs) != 0) {
                    $this->afficher('changer_mdp', [
                        'erreurs' => $erreurs,
                        'aff' => $aff
                    ]);
                } elseif (count($erreurs) === 0 and $testminutes <= 15 and $testheures <= 1 and $testjours < 1 and $testmois < 1 and $testannee < 1) {
                    $_POST['mdp_compte']=password_hash($_POST['mdp_compte'],PASSWORD_DEFAULT);
                    $changermdp = $utilisateurs->changerMdp($tokenrecup);
                    if ($changermdp['resultat'] === true) {
                        $aff = true;
                        $del = $utilisateurs->supprimerToken($tokenrecup);
                        if ($del['resultat'] === true) {
                            $this->afficher('changer_mdp', [
                                'aff' => $aff,

                            ]);
                        }
                    }
                }
            }
        }
    }


}