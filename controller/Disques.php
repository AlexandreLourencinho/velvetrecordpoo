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
        if (!isset($_POST['envoi'])) {
            $artiste = $this->chargerModel('Artist');
            $truc = $artiste->listeArtiste();
            $aff = false;
            $this->afficher('formulaire_ajout', ['artistes' => $truc, 'aff' => $aff]);

        } elseif (isset($_POST['envoi'])) {
            $artiste = $this->chargerModel('Artist');
            $truc = $artiste->listeArtiste();
            $img = false;
            unset($_POST['image']);

            //tableaux
            $tableTypesMimes = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff", "image/bmp", "image/gif");
            $regexTab = ['titre' => '/[<\/`\'"\>#]/',
                'artiste' => '/[<\/`\'"\>]/',
                'annee' => '#([^0-9] | ^[0-9]{1,3}$ | [0-9]{5,})#x',
                'genre' => '/[<\`\'"\>#]/',
                'label' => '/[<\/`\'"\>#]/',
                'prix' => '#[^0-9.]#'];


            $formulaire = $this->chargerFonction('checkForm');


            unset($_POST['envoi']);
            $resultat = $formulaire->checkForme($regexTab, $_POST);


            //is_ploaded_file sert a savoir si un fichier a été uploadé ou non : semble mieux marcher que empty() ou isset()
            if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                // ouverture du fihier et détermination de son type mime
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $typeMime = finfo_file($finfo, $_FILES['image']['tmp_name']);
                finfo_close($finfo);
                // si le type mime du fichier correspond au résultat attendu, la variable $img passe a true, et le nouveau nom de l'image
                // est définit.
                if (in_array($typeMime, $tableTypesMimes)) {
                    /* Le type est parmi ceux autorisés, donc OK */
                    $tempvar = uniqid();
                    $nouveaunom = $tempvar . ".jpg";
                    $img = true;
                    $_POST['image'] = $nouveaunom;
                } else {
                    // si le type ne correspond pas, on insert dans le tableau d'erreur le message d'erreur ici bas.
                    $resultat['image'] = "type de fichier non autorisé";

                }
            } else {
                $_POST['image'] = null;
            }
            if (count($resultat) === 0) {
                // et déplacement du fichier vers le dossier correspondant, + attribution des droits en lecture seule (normalement ^^)
                if ($img === true) {
                    move_uploaded_file($_FILES['image']['tmp_name'], ROOT . "/assets/images/" . $nouveaunom);
                    var_dump($_POST);
                }

                $disque = $this->chargerModel('Disc');
                $resultat = $disque->ajouterDisque();
                if ($resultat['resultat'] === false) {
                    echo "erreur lors de l'insertion";
                    $aff = false;
                    var_dump($resultat);
                    var_dump($_POST);
                    $this->afficher('formulaire_ajout', ['artistes' => $truc,
                        'resultat' => $resultat, 'aff' => $aff
                    ]);
                    die;
                } elseif ($resultat['resultat'] === true) {
                    $aff = true;
                    unset($_POST);
                    $this->afficher('formulaire_ajout', ['artistes' => $truc,
                        'resultat' => $resultat, 'aff' => $aff
                    ]);

                }
            } elseif (count($resultat) != 0) {
                $artiste = $this->chargerModel('Artist');
                $truc = $artiste->listeArtiste();
                $aff = false;
                var_dump($resultat);
//                die;
                $this->afficher('formulaire_ajout', ['artistes' => $truc,
                    'aff' => $aff,
                    'resultat' => $resultat
                ]);

            }
        }


//              var_dump($resultat);

    }


    public function form_modif($id)
    {
        $aff = false;
        if (!isset($_POST['envoi'])) {
            $modeldisque = $this->chargerModel('Disc');
            $detaildisque = $modeldisque->getOne($id);
            $modelartist = $this->chargerModel('Artist');
            $artistes = $modelartist->listeArtiste();
            $this->afficher('formulaire_modif',
                [
                    'disqueDetail' => $detaildisque,
                    'artistes' => $artistes,
                    'aff'=>$aff
                ]);
        } elseif (isset($_POST['envoi'])) {
            $modeldisque = $this->chargerModel('Disc');
            //tableaux
            $tableTypesMimes = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff", "image/bmp", "image/gif");
            $regexTab = ['titre' => '/[<\/`\'"\>#]/',
                'artiste' => '/[<\/`\'"\>]/',
                'annee' => '#([^0-9] | ^[0-9]{1,3}$ | [0-9]{5,})#x',
                'genre' => '/[<\`\'"\>#]/',
                'label' => '/[<\/`\'"\>#]/',
                'prix' => '#[^0-9.]#'];
            $img = false;
            unset($_POST['image']);
            $formulaire = $this->chargerFonction('checkForm');
            unset($_POST['envoi']);
            $resultat = $formulaire->checkForme($regexTab, $_POST);

            //is_ploaded_file sert a savoir si un fichier a été uploadé ou non : semble mieux marcher que empty() ou isset()
            if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                // ouverture du fihier et détermination de son type mime
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $typeMime = finfo_file($finfo, $_FILES['image']['tmp_name']);
                finfo_close($finfo);
                // si le type mime du fichier correspond au résultat attendu, la variable $img passe a true, et le nouveau nom de l'image
                // est définit.
                if (in_array($typeMime, $tableTypesMimes)) {
                    /* Le type est parmi ceux autorisés, donc OK */
                    $tempvar = uniqid();
                    $nouveaunom = $tempvar . ".jpg";
                    $img = true;
                    $_POST['image'] = $nouveaunom;
                } else {
                    // si le type ne correspond pas, on insert dans le tableau d'erreur le message d'erreur ici bas.
                    $resultat['image'] = "type de fichier non autorisé";

                }

            }
            if (count($resultat) === 0) {
                $resultmodif = $modeldisque->modifDisque($id);
                if($img===true AND $resultmodif['resultat']===true){
                    move_uploaded_file($_FILES['image']['tmp_name'], ROOT . "/assets/images/" . $nouveaunom);
                    $resultimage=$modeldisque->modifImage($id);
                }
                if ($resultmodif['resultat'] === true) {
                    $aff = true;
                    $this->afficher('formulaire_modif',
                        [
                            'aff' => $aff
                        ]);

                }
            }
            elseif(count($resultat) != 0 ){
                $detaildisque = $modeldisque->getOne($id);
                $modelartist = $this->chargerModel('Artist');
                $artistes = $modelartist->listeArtiste();
                $this->afficher('formulaire_modif',
                    [
                        'verifform'=>$resultat,
                        'disqueDetail' => $detaildisque,
                        'artistes' => $artistes,
                        'aff'=>$aff
                    ]);

            }


        }
    }

    public function supdisque($id){
        if(!isset($_POST['envoi'])){
            $disque = $this->chargerModel('Disc');
            $disqueuh = $disque->getOne($id);
            $aff=false;
            $this->afficher('formulaire_suppression', [
                'disqueDetail' => $disqueuh,
                'aff'=>$aff
            ]);
        }
        elseif(isset($_POST['envoi'])){
            $disque = $this->chargerModel('Disc');
            $suppression = $disque->supprimerDisque($id);
            $aff=true;
            $this->afficher('formulaire_suppression', [
                'aff'=>$aff
                ]);
        }

    }

}