<?php


class CheckForm
{
    public function checkFormDisc(array $regex, array $tabPost)
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

    function checkFormUser($nom,$mdp,$mdp2,$mail)
    {
        $erreurs = [];
        if($mdp!=$mdp2){
            $erreurs['mdp2']='les mots de passe sont différents';
        }
        if(!preg_match('#^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$#',$mdp)){
            $erreurs['mdp']='Le mot de passe doit contenir au moins une minuscule, une majuscule et un chiffre';
        }
        if(strlen($mdp)<8){
            $erreurs['mdp']='Le mot de passe doit contenir au moins 8 caractères';
        }
        if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
            $erreurs['mail']='Veuillez entrer un email au format valide : exemple@truc.fr';
        }
        if(preg_match('/[<\/`\'"\>#!\?]/',$nom)){
            $erreurs['nom']= 'Le nom ne doit pas contenir de caractères spéciaux : points, barres obliques, chevrons, guillemets...';
        }
        if(strlen($nom)===0){
            $erreurs['nom']='tous les champs sont obligatoires';
        }
        if(strlen($mdp)===0){
            $erreurs['mdp']='Tous les champs sont obligatoires';
        }
        if(strlen($mail)===0){
            $erreurs['mail']='Tous les champs sont obligatoires';
        }
        return $erreurs;
    }


}