<?php


class Disc extends ModelParent
{
    public function __construct(){
        //définie la table sur disc
        $this->table="disc";
        //recupère la connexion via modelparent et la fonction getConnexion
        $this->getConnexion();
    }
}