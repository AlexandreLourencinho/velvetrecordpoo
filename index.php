<?php
session_start();
//$_SESSION['login']='alex';
//var_dump($_SESSION);


//rooter qui permet d'aller dans tel ou tel controller ou methode


//recupère le root du projet et le stocke dans la constante ROOT
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once ROOT . "/app/AbstractController.php";
require_once ROOT . '/app/ModelParent.php';

//recupère et stocke l'uri
$uri = $_SERVER['REQUEST_URI'];
//mettre l'uri dans un tableau séparé par les /
$parametres = explode("/", $_SERVER['REQUEST_URI']);


//si le premier mot derrière le / est set :
if ($parametres[1] != '') {

    // on recupère son nom ; ça sera le nom de la classe
    $classe = ucfirst($parametres[1]);
    $methode = isset($parametres[2]) ? $parametres[2] : 'index';


    if (file_exists(ROOT . "/controller/" . $classe . ".php")) {

        // si le fichier existe on le require
        require ROOT . "/controller/" . $classe . ".php";

        // instancie la classe récupérée si elle existe
        $classe = new $classe;

        if (method_exists($classe, $methode)) {
            // unset le 0 1 et 2 pour ne pas passer le nom de la classe et de la methode en paramètre

            unset($parametres[0]);
            unset($parametres[1]);
            unset($parametres[2]);


            // equivalent ici de $classe->$methode($parametre);
            call_user_func_array([$classe, $methode], $parametres);
        } else {
            http_response_code(404);
            echo 'erreur 404 : la méthode demandée n\'existe pas alros ntm';
        }
    } else {
        http_response_code(404);
        echo 'erreur 404 : ntm la classe demandée n\'existe pas';
    }
} else {
    require ROOT . '/controller/Accueil.php';
    $accueil = new Accueil();
    call_user_func_array([$accueil, 'pageAccueil'], $parametres);
}


