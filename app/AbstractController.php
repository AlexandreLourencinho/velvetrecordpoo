<?php
//abstract class = on ne peut pas faire new classe pour l'instancier : elle ne sera que dépendante d'une classe fille
abstract class AbstractController
{
    /**
     * fonction qui sert a appeler les model correspondants
     * @param string $model
     * @return mixed
     */
    public function chargerModel(string $model)
    {
        require_once ROOT . "/model/" . $model . ".php";
        return new $model;
    }

    /**
     * charge la classe fonction avec les checkform (a priori ici y'aura que ça )
     * @param string $fonction
     * @return mixed
     */
    public function chargerFonction(string $fonction)
    {
        require_once ROOT . "/fonction/" . $fonction . ".php";
        return new $fonction;
    }

    /**
     * methode générant l'affichage
     * @param string $fichier
     * @param array $donnees
     */
    public function afficher(string $fichier, array $donnees = [])
    {
        //mettre = [] dans les paramètres de la fonction veut dire qu'il PEUT être absent

        // le extract prends les données du tableau $donnees et génère des variables a partir des clefs du tableau
        // qui auront comme valeur les values du tableau
        extract($donnees);


        // permet de démarrer un buffer et de le stocker plus tard dans une variable (ici $contenu)
        ob_start();

        //le getclass $this , le $^this sera la classe ou est appelée cette méthode
        require_once ROOT . "/view/" . strtolower(get_class($this)) . "/" . $fichier . ".php";

        //charge le contenu de la page dans la variale contenu, affichée dans le template de base
        $contenu = ob_get_clean();

        //titre "dynamique" (pas trouvé mieux pour ça)
        $titre = $fichier . " de velvet record";

        //require a chaque fois le corps de la page aka le header et footer
        require_once ROOT . "/view/template/corps.php";

    }


}