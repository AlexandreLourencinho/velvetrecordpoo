<?php

//abstract controller parce que gestion de la vue
class Disques extends AbstractController
{

    /**
     * affiche recupère liste des disques et charge l'affichage
     *
     */
    public function listeDisques()
    {
        //charge le model via chargermodel dans abstractcontroller
        $disques = $this->chargerModel('Disc');
        //utilise la fonction getAll faite dans modelparent qui est étendue par le model/disc
        $listedisques = $disques->disqueParArtiste();
        $nombre = $disques->compterDisque();
//        var_dump($nombre);
//        die;
        $this->afficher('listeDisques', [
            'disques' => $listedisques,
            'nombre' => $nombre
        ]);
    }

    public function detailsDisques($id)
    {
        $disque = $this->chargerModel('Disc');
        $disqueuh = $disque->getOne($id);
        $this->afficher('detailsDisques', [
            'details' => $disqueuh
        ]);
    }

    public function form_ajout()
    {
        if(!isset($_POST['envoi'])) {
            $artiste = $this->chargerModel('Artist');
            $truc = $artiste->listeArtiste();
            $this->afficher('formulaire_ajout', ['artistes' => $truc]);
        }
        elseif(isset($_POST['envoi'])){
            $artiste = $this->chargerModel('Artist');
            $truc = $artiste->listeArtiste();

//            var_dump($_POST);
              $regexTab = ['titre' => '/[<\/`\'"\>#]/',
                'artiste' => '/[<\/`\'"\>]/',
                'annee' => '#([^0-9] | ^[0-9]{1,3}$ | [0-9]{5,})#x',
                'genre' => '/[<\`\'"\>#]/',
                'label' => '/[<\/`\'"\>#]/',
                'prix' => '#[^0-9.]#'];
              $formulaire = $this->chargerFonction('checkForm');
              unset($_POST['envoi']);
              $resultat=$formulaire->checkForme($regexTab,$_POST);
//              var_dump($_POST['envoi']);
              var_dump($resultat);
            $this->afficher('formulaire_ajout', ['artistes' => $truc,
                'resultat'=>$resultat
                ]);
            if(count($resultat)===0){
                if(!is_uploaded_file($_FILES['image']['tmp_name'])){
                    $_POST['image']=null;
                }
                $disque = $this->chargerModel('Disc');
                $resultat=$disque->ajouterDisque();
                var_dump($resultat);
            }
//              var_dump($resultat);

        }
    }


    public function form_modif($id){
//        if(!isset($_POST['envoi'])) {
            $artiste = $this->chargerModel('Artist');
            $truc = $artiste->listeArtiste();
            $disque = $this->chargerModel('Disc');
            $detaildisque = $disque->getOne($id);
//            var_dump($detaildisque);
//            die;
            $this->afficher('formulaire_modif',
                [
                    'artistes' => $truc,
                    'disqueDetail'=>$detaildisque
                ]);
//        }
    }


    public function supprimer_disque($id){
        $disque = $this->chargerModel('Disc');
        $detaildisque = $disque->getOne($id);
        $this->afficher('formulaire_suppression',
            [
                'disqueDetail'=>$detaildisque
            ]);
    }

    public function testpost(){

        var_dump($_POST);

    }


}