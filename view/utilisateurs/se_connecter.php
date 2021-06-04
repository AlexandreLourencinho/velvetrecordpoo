<?php



if($aff===false){
?>
<!--formulaire de connexion-->
<form action="/utilisateurs/formulaire_connexion" method="post" class="form-group col-12 col-md-8 mt-md-5 mb-md-5">
    <h1><u><b>Se connecter à son compte Velvet Record!</b></u></h1>
    <p class="<?= isset($message) ? "alert alert-warning" : "" ?> "><?= $message ?? "" ?></p>
    <label for="nom_compte" class="form-label mt-md-5 ms-md-1 me-md-1  fondopac text-light mt-1">Votre nom de compte
        : </label>
    <input type="text" class="form-control mb-2 ms-md-1 me-md-1" id="nom_compte" value="<?= $_POST['nom_compte'] ?? '' ?>" name="nom_compte"
           placeholder="Entrez votre nom de compte">
    <label for="mdp_compte" class="form-label fondopac text-light mt-2 ms-md-1 me-md-1"> Votre mot de passe :</label>
    <input type="text" class="form-control mb-2 ms-md-1 me-md-1" id="mdp_compte" value="<?= $_POST['mdp_compte'] ?? '' ?>" name="mdp_compte"
           placeholder=" Entrez votre mot de passe">
    <label for="mail_compte" class="form-label fondopac mt-2 ms-md-1 me-md-1 text-light">Votre adresse éléctronique
        :</label>
    <input type="text" class="form-control mt-2 ms-md-1 me-md-1" id="mail_compte" value="<?= $_POST['mail_compte'] ?? '' ?>" name="mail_compte"
           placeholder="Entrez votre adresse email">
    <div class="d-flex flex-column mt-3 col-12">
        <button type="submit" class="btn btn-primary mb-1 align-self-center col-12" name="envoi"> Se connecter</button>
        <a href="/utilisateurs/recup_mdp" class=" text-center text-info mb-1" title="cliquez ici si vous avez oublié votre mot de passe">mot
            de passe oublié?</a>
        <a href="#" class="btn btn-success align-self-center col-12 col-md-8 mb-md-5">Pas de compte? Créez en un !</a>
    </div>
</form>
<?php
}elseif($aff===true){
    ?>
    <div class="d-flex flex-column">
        <h1 class="text-info">Vous êtes bien connecté, <?= $_SESSION['nom'] ?> !</h1>
        <a href="/disques/listeDisques" class="btn btn-info">Retour à la liste des disques</a>
        <p>Vous allez être redirigé dans <span id="compteur">5</span> secondes à la liste des disques...</p>
    </div>
    <!--    appel du script du compteur-->
    <script src="/assets/javaScript/scripts.js"></script>
    <?php
    header("refresh: 5; url=/disques/listeDisques");
}
?>
