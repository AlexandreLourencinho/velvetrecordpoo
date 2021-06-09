
<?php

if(isset($message)){
    ?>
    <h1><?= $message ?></h1>
    <p>vous serez redirigé dans 3 secondes</p>

<?php
    header('refresh:3; url=/disques/listeDisques');
}else{
?>
<!--changement mdp-->
<form action="" method="post" class="form-group">
    <label for="mdp" class="form-label text-light fondopac">Entrez votre nouveau mot de passe : *</label>
    <input type="text" name="mdp_compte" placeholder="entrez votre mot de passe" id="mdp" class="form-control">
    <p class="<?= isset($erreurs['mdp_compte']) ? 'alert alert-danger' : '' ?>"><?= $erreurs['mdp_compte'] ?? '' ?></p>
    <label for="mdp2" class="form-label text-light fondopac">Confirmez votre nouveau mot de passe : *</label>
    <input type="text" name="mdp_compte_verif" placeholder="confirmez votre mot de passe" id="mdp2" class="form-control">
    <p class="<?= isset($erreurs['mdp_compte_verif']) ? 'alert alert-danger' : '' ?>"><?= $erreurs['mdp_compte_verif'] ?? '' ?></p>
<!--    <input type="hidden" value="" name="aut">-->
<!--    <input type="hidden" value="" name="token">-->
    <button class="btn btn-primary mt-2" name="envoi" type="submit">changer le mdp</button>
</form>

<?php
}
    ?>