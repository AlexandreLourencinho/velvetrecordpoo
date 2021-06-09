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
        if($_POST['mdp_compte']!=$_POST['mdp_compte_verif']){
            $erreurs['mdp_compte_verif']='les mots de passe sont différents';
        }
        if(!preg_match('#^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$#',$_POST['mdp_compte'])){
            $erreurs['mdp_compte']='Le mot de passe doit contenir au moins une minuscule, une majuscule et un chiffre';
        }
        if(strlen($_POST['mdp_compte'])<8){
            $erreurs['mdp_compte']='Le mot de passe doit contenir au moins 8 caractères';
        }
        if(!filter_var($_POST['mail_compte'],FILTER_VALIDATE_EMAIL)){
            $erreurs['mail_compte']='Veuillez entrer un email au format valide : exemple@truc.fr';
        }
        if(preg_match('/[<\/`\'"\>#!\?]/',$_POST['nom_compte'])){
            $erreurs['nom_compte']= 'Le nom ne doit pas contenir de caractères spéciaux : points, barres obliques, chevrons, guillemets...';
        }
        if(strlen($_POST['nom_compte'])===0){
            $erreurs['nom_compte']='tous les champs sont obligatoires';
        }
        if(strlen($_POST['mdp_compte'])===0){
            $erreurs['mdp_compte']='Tous les champs sont obligatoires';
        }
        if(strlen($_POST['mail_compte'])===0){
            $erreurs['mail_compte']='Tous les champs sont obligatoires';
        }
        return $erreurs;
    }

    public function checkFormMdp(){
        $erreurs=[];
        if($_POST['mdp_compte']!=$_POST['mdp_compte_verif']){
            $erreurs['mdp_compte_verif']='les mots de passe sont différents';
        }
        if(strlen($_POST['mdp_compte'])<8){
            $erreurs['mdp_compte']='Le mot de passe doit contenir au moins 8 caractères';
        }
        if(!preg_match('#^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$#',$_POST['mdp_compte'])){
            $erreurs['mdp_compte']='Le mot de passe doit contenir au moins une minuscule, une majuscule et un chiffre';
        }
        return $erreurs;

    }

}