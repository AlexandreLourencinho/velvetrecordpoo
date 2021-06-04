<?php


class Utilisateurs extends AbstractController
{

    public function formulaire_connexion()
    {
//        $modelutilisateur = $this->chargerModel('utilisateur');
        if (!isset($_POST['envoi'])) {
            $this->afficher('se_connecter', []);
        }

    }

    public function creer_compte()
    {
        if (!isset($_POST['envoi'])) {
            $this->afficher('inscription', []);
        }
    }


}