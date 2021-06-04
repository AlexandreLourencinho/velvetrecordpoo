<?php

//abstract controller parce que gestion de la vue
class Disques extends AbstractController
{

    /**
     * recupère liste des disques et charge l'affichage
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

    /**
     * récupère les détails d'un disque et génère l'affichage
     * @param $id
     */
    public function detailsDisques($id)
    {
        $disque = $this->chargerModel('Disc');
        $disqueuh = $disque->getOne($id);
        $this->afficher('detailsDisques', [
            'details' => $disqueuh
        ]);
    }

    /**
     * gère le formulaire d'ajout
     */
    public function form_ajout()
    {
        if(!isset($_SESSION['nom'])){
            header('location: /utilisateurs/formulaire_connexion');
        }
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
    }


    /**
     * gère le formulaire de modification
     * @param $id
     */
    public function form_modif($id)
    {
        if(!isset($_SESSION['nom'])){
            header('location: /utilisateurs/formulaire_connexion');
        }
        // variable utilisée pour l'affichage
        $aff = false;

        // si formulaire pas envoyé
        if (!isset($_POST['envoi'])) {
            // charge la liste des artistes et le modèle disque
            $modeldisque = $this->chargerModel('Disc');
            $detaildisque = $modeldisque->getOne($id);
            $modelartist = $this->chargerModel('Artist');
            $artistes = $modelartist->listeArtiste();

            //lance l'affichage de la page modif avec les détails du disque a modifier, la liste déroulante des artistes
            // et la variable d'affichage
            $this->afficher('formulaire_modif',
                [
                    'disqueDetail' => $detaildisque,
                    'artistes' => $artistes,
                    'aff' => $aff
                ]);

            //si le formulaire est bien envoyé
        } elseif (isset($_POST['envoi'])) {

            //charge le modèle disc
            $modeldisque = $this->chargerModel('Disc');

            //tableaux types mime et regex
            $tableTypesMimes = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff", "image/bmp", "image/gif");
            $regexTab = ['titre' => '/[<\/`\'"\>#]/',
                'artiste' => '/[<\/`\'"\>]/',
                'annee' => '#([^0-9] | ^[0-9]{1,3}$ | [0-9]{5,})#x',
                'genre' => '/[<\`\'"\>#]/',
                'label' => '/[<\/`\'"\>#]/',
                'prix' => '#[^0-9.]#'];

            //varibalbe utile pour la gestion de l'image
            $img = false;

            // charge la classe contenant la vérif de formulaire
            $formulaire = $this->chargerFonction('checkForm');

            //unset le post image et post envoi pour éviter les erreurs inutiles.
            unset($_POST['image']);
            unset($_POST['envoi']);

            //utilise la fonction de vérif formulaire et stock le tableau dans la variable resultat
            $resultat = $formulaire->checkForme($regexTab, $_POST);

            //is_uploaded_file(fichier) sert à savoir si un fichier a été uploadé ou non : semble mieux marcher que empty() ou isset()
            if (is_uploaded_file($_FILES['image']['tmp_name'])) {

                // ouverture du fihier et détermination de son type mime
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $typeMime = finfo_file($finfo, $_FILES['image']['tmp_name']);
                finfo_close($finfo);
                // si le type mime du fichier correspond au résultat attendu, la variable $img passe a true, et le nouveau nom de l'image
                // est définit.
                if (in_array($typeMime, $tableTypesMimes)) {
                    // Le type est parmi ceux autorisés, on génère un nouveau nom a l'image, on passe la variable img
                    // a true pour la gestion de l'image, et on set le $_POST correspondant avec ce nouveau nom.
                    // le $_POST sert ici a l'execution de la requête, comme la construction se fait sans paramètre ici.
                    // uniqid génère un numéro unique, basé sur le timestamp (apparemment)
                    $tempvar = uniqid();
                    $nouveaunom = $tempvar . ".jpg";
                    $img = true;
                    $_POST['image'] = $nouveaunom;

                } else {
                    // si le type ne correspond pas, on insert dans le tableau d'erreur le message d'erreur correspondant
                    $resultat['image'] = "type de fichier non autorisé";
                }

            }

            //si le tableau de résultat d'erreurs n'en contient pas :
            if (count($resultat) === 0) {

                //appel de la fonction de modification du disque avec en paramètre l'id du disque
                $resultmodif = $modeldisque->modifDisque($id);

                //si la variable de gestion d'image est sur true => il y a une image et a passé la vérification du type
                // mime. + si la requête précédente s'est bien executée
                if ($img === true and $resultmodif['resultat'] === true) {

                    //déplacement de l'image
                    move_uploaded_file($_FILES['image']['tmp_name'], ROOT . "/assets/images/" . $nouveaunom);
                    $resultimage = $modeldisque->modifImage($id);
                }

                //change l'affichage si la requête de modification s'est bien executée
                if ($resultmodif['resultat'] === true) {
                    if (!isset($resultimage)) {
                        $resultimage = null;
                    }
                    $aff = true;
                    $this->afficher('formulaire_modif',
                        [
                            'aff' => $aff,
                            'image' => $resultimage
                        ]);

                }

                //si il y a au moins une erreur :
            } elseif (count($resultat) != 0) {
                // on recharge les infos du modèle disque, modèle artiste, on renvoi les erreurs dans un tableau pour
                // être affichés dans la vue ainsi que la variable d'affichage (qui est ici toujours sur false)
                $detaildisque = $modeldisque->getOne($id);
                $modelartist = $this->chargerModel('Artist');
                $artistes = $modelartist->listeArtiste();
                $this->afficher('formulaire_modif',
                    [
                        'verifform' => $resultat,
                        'disqueDetail' => $detaildisque,
                        'artistes' => $artistes,
                        'aff' => $aff
                    ]);

            }
        }
    }


    /**
     * gère le formulaire de suppression
     * @param $id
     */
    public function supdisque($id)
    {
        if(!isset($_SESSION['nom'])){
            header('location: /utilisateurs/formulaire_connexion');
        }
        if (!isset($_POST['envoi'])) {
            $disque = $this->chargerModel('Disc');
            $disqueuh = $disque->getOne($id);
            $aff = false;
            $this->afficher('formulaire_suppression', [
                'disqueDetail' => $disqueuh,
                'aff' => $aff
            ]);
        } elseif (isset($_POST['envoi'])) {
            $disque = $this->chargerModel('Disc');
            $suppression = $disque->supprimerDisque($id);
            $aff = true;
            $this->afficher('formulaire_suppression', [
                'aff' => $aff
            ]);
        }

    }

}