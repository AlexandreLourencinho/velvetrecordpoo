<?php


class Accueil extends AbstractController
{
//    public function __construct(){
//        au cas ou
//    }

    public function pageAccueil(){
//le this ici appelle la classe accueil : avec la methode de la classe mère abstractcontroller
        $this->afficher('accueil');
    }


}