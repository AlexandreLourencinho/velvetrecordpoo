<?php


class checkForm
{


    function checkForme(array $regex, array $tabPost)
    {
        $erreurs = [];
        foreach ($tabPost as $name => $value) {
            if (!empty($tabPost[$name])) {
                if (preg_match($regex[$name], $tabPost[$name])) {
                    $erreurs[$name] = 'Caractère non valide';
                }
            } else {
                $erreurs[$name] = 'tous les champs sont obligatoires';
            }
        }
        return $erreurs;

    }

   public function checkFormUser()
    {
        $erreurs = [];
        if($_POST['mdp']!=$_POST['mdp2']){
            $erreurs['mdp2']='les mots de passe sont différents';
        }
        if(!preg_match('#^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$#',$_POST['mdp'])){
            $erreurs['mdp']='Le mot de passe doit contenir au moins une minuscule, une majuscule et un chiffre';
        }
        if(strlen($_POST['mdp'])<8){
            $erreurs['mdp']='Le mot de passe doit contenir au moins 8 caractères';
        }
        if(!filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL)){
            $erreurs['mail']='Veuillez entrer un email au format valide : exemple@truc.fr';
        }
        if(preg_match('/[<\/`\'"\>#!\?]/',$_POST['nom'])){
            $erreurs['nom']= 'Le nom ne doit pas contenir de caractères spéciaux : points, barres obliques, chevrons, guillemets...';
        }
        if(strlen($_POST['nom'])===0){
            $erreurs['nom']='tous les champs sont obligatoires';
        }
        if(strlen($_POST['mdp'])===0){
            $erreurs['mdp']='Tous les champs sont obligatoires';
        }
        if(strlen($_POST['mail'])===0){
            $erreurs['mail']='Tous les champs sont obligatoires';
        }
        return $erreurs;
    }

}