
<?php
if($aff===false){
?>
<!--formulaire mdp oublie-->
<form action="" method="post" class="form-group mb-1">
    <div class="<?= isset($message) ? 'alert alert-warning' : '' ?>"> <?= $message ?? '' ?></div>
    <label for="mail_compte" class="form-label">Veuillez renseigner l'email de votre compte : *</label>
    <input type="text" id="mail_compte" name="mail_compte" class="form-control" placeholder="votre email">

    <div class="d-flex flex-row mt-1">
    <button type="submit" name="envoi" class="btn btn-light me-1">envoyer</button>
    <a href="/disques/listeDisques" class="btn btn-dark ms-1 me-1">Retour liste disque</a>
    <a href="#" class="btn btn-info">Se connecter</a>

    </div>

</form>
<?php
}elseif($aff===true){
    ?>
        <div class="d-flex flex-column">
<h1 class="text-center">Un mail a bien été envoyé a <?= $_POST['mail_compte'] ?></h1>
            <h2 class="text-center">Verifiez votre boite mail pour la suite de la procédure.</h2>
            <h3 class="text-center">Vous allez être redirigé dans quelques secondes...</h3>
        </div>
<?php
    header("refresh: 5; url=/disques/listeDisques");
}
?>
