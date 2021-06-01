<?php

//abstract controller parce que gestion de la vue
class Disques extends AbstractController
{

    /**
     * affiche recupère liste des disques et charge l'affichage
     *
     */
    public function listeDisques(){
        //charge le model via chargermodel dans abstractcontroller
        $disques=$this->chargerModel('Disc');
        //utilise la fonction getAll faite dans modelparent qui est étendue par le model/disc
        $listedisques = $disques->getAll();
        $this->afficher('listeDisques',[
            'disques'=>$listedisques
        ]);




    }
}