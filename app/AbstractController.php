<?php

//abstract class = on ne peut pas faire new classe pour l'instancier : elle ne sera que dépendante d'une classe fille
abstract class AbstractController
{


    public function afficher(string $fichier, array $donnees = []){
    //mettre = null dans les paramètres de la fonction veut dire qu'il PEUT être absent
        // le extract prends les données du tableau $donnees et génère des variables a partir des clefs du tableau
        // qui auront comme valeur les values du tableau
        extract($donnees);


        // permet de démarrer un buffer et de le stocker plus tard dans une variable (ici $contenu)
        ob_start();
        //le getclass $this , le $^this sera la classe ou est appelée cette méthode
        require_once ROOT . "view/" . strtolower(get_class($this)) ."/". $fichier . ".php";
        $contenu = ob_get_clean();
        var_dump($contenu);
//        die;
        require_once ROOT . "view/template/corps.php";

    }




}