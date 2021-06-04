
<?php

if(isset($message)){
    ?>
    <h1><?= $message ?></h1>

<?php
}else{
?>
<!--changement mdp-->
<form action="" method="post" class="form-group">
    <label for="mdp" class="form-label text-light fondopac">Entrez votre nouveau mot de passe : *</label>
    <input type="text" name="mdp" placeholder="entrez votre mot de passe" id="mdp" class="form-control">
    <label for="mdp2" class="form-label text-light fondopac">Confirmez votre nouveau mot de passe : *</label>
    <input type="text" name="mdp2" placeholder="confirmez votre mot de passe" id="mdp2" class="form-control">
    <input type="hidden" value="" name="aut">
    <input type="hidden" value="" name="token">
    <button class="btn btn-primary mt-2" name="envoi" type="submit">changer le mdp</button>
</form>

<?php
}
    ?>