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
        $listedisques = $disques->disqueParArtiste();
        $this->afficher('listeDisques',[
            'disques'=>$listedisques
        ]);
    }

    public function detailsDisques($id){
        $disque=$this->chargerModel('Disc');
        $detaildisque=$disque->getOne($id);
//        var_dump($detaildisque);
//        die;
        $this->afficher('detailsDisques',[
            'details'=>$detaildisque
        ]);
    }
}