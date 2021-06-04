
<?php
if($aff===false){
?>
<!--formulaire de création de compte-->

<div class="mb-md-5 "></div>

<form action="#" method="post" class="form-group col-12 col-md-6 pt-md-5 ">
    <h1 class=""><u><b>S'inscrire sur velvet record :</b></u></h1>
    <label for="nom_compte" class="form-label mt-md-5 text-light fondopac">Votre nom de compte :*</label>
    <input type="text" class="form-control" value="<?= $_POST['nom_compte'] ?? '' ?>" id="nom_compte" name="nom_compte" placeholder="Saisissez le nom de compte que vous souhaiter utiliser">
    <p class="<?= isset($erreurs['nom_compte']) ? 'alert alert-danger' : '' ?>"><?= $erreurs['nom_compte'] ?? ''; ?></p>

    <label for="mdp_compte" class="form-label text-light fondopac"> Votre mot de passe :*</label>
    <input type="password" class="form-control" value="<?= $_POST['mdp_compte'] ?? '' ?>" id="mdp_compte" name="mdp_compte" placeholder="Saisissez votre mot de passe">
    <p class="<?= isset($erreurs['mdp_compte'])? 'alert alert-danger' : '' ?>"><?= $erreurs['mdp_compte'] ?? ''; ?></p>

    <label for="mdp_compte_verif" class="form-label text-light fondopac"> Confirmez votre mot de passe :*</label>
    <input type="password" class="form-control" value="<?= $_POST['mdp_compte_verif'] ?? '' ?>" id="mdp_compte_verif" name="mdp_compte_verif" placeholder="confirmez votre mot de passe">
    <p class="<?= isset($erreurs['mdp_compte_verif']) ? 'alert alert-danger' : '' ?>"><?= $erreurs['mdp_compte_verif'] ?? ''; ?></p>

    <label for="mail_compte" class="form-label text-light fondopac">Votre adresse éléctronique :*</label>
    <input type="text" class="form-control" id="mail_compte" value="<?= $_POST['mail_compte'] ?? '' ?>" name="mail_compte" placeholder="saisissez votre email">
    <p class="<?= isset($erreurs['mail_compte']) ? 'alert alert-danger' : '' ?>"><?= $erreurs['mail_compte'] ?? ''; ?></p>

    <div class="d-flex flex-column mt-3 col-12">
        <button type="submit" class="btn btn-success mb-1 align-self-center col-12" name="envoi"> S'inscrire</button>
        <a href="/" class=" text-center btn btn-dark mb-1">retour a l'accueil</a>
        <a href="/disques/listeDisques" class=" text-center btn btn-info mb-1">retour à la liste des disques</a>
    </div>
</form>
<?php
}elseif($aff===true){
    ?>
    <div class="d-flex flex-column">
        <h1 class="text-info">Votre compte à bien été créé</h1>
        <a href="/disques/listeDisques" class="btn btn-info">Retour à la liste des disques</a>
        <p>Vous allez être redirigé dans <span id="compteur">5</span> secondes à la page de connexion...</p>
    </div>
    <!--    appel du script du compteur-->
    <script src="/assets/javaScript/scripts.js"></script>
    <?php
    header("refresh: 5; url=/utilisateurs/formulaire_connexion");
}
?>

