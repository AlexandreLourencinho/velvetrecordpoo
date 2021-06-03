<?php
if($aff===false){
?>

<form enctype="multipart/form-data" action="/disques/form_ajout" method="post"
          class="form-group col-12 col-md-8 d-flex flex-column">
<!--        titre-->
        <label for="titre" class="text-light">Title :</label>
        <input type="text" placeholder="Entrez le titre du disque" id="titre" name="titre" class="form-control col-12 col-md-8 mb-md-2" value="<?= $_POST['titre'] ?? '' ?>">
        <span class="<?= isset($resultat['titre']) ? 'alert alert-danger' : '' ?> text-center"><?= $resultat['titre'] ?? ''; ?></span>
<!--        artiste-->
<label for="artiste" class="text-light mt-md-2">Artiste :</label>
<select class="form-select col-12 col-md-8 mb-md-2" aria-label="Default select example" id="artiste" name="artiste" >
    <option <?= !isset($_POST['artiste']) ? 'selected' : ''; ?> value="">- Séléctionnez un artiste -</option>
    <?php
    foreach ($artistes as $artiste) {

        ?>
        <option <?= isset($_POST['artiste']) && $_POST['artiste'] === $artiste->artist_id ? 'selected' : ''; ?>
                value="<?= $artiste->artist_id ?>"><?= $artiste->artist_name ?></option>
    <?php } ?>

</select>
<span class="<?= isset($resultat['artiste']) ? 'alert alert-danger' : '' ?> text-center"><?= $resultat['artiste'] ?? ''; ?></span>
<!--        année du disque-->
<label for="annee" class="text-light mt-md-2"> Year :</label>
<input type="text" id="annee" name="annee" class="form-control col-12 col-md-8 mb-md-2" value="<?= $_POST['annee'] ?? '' ?>" placeholder="Entrez l'année de sortie du disque">
<span class="<?= isset($resultat['annee']) ? 'alert alert-danger' : '' ?> text-center"><?= $resultat['annee'] ?? ''; ?></span>
<!--        genre du disque-->
<label for="genre" class="text-light mt-md-2">Genre :</label>
<input type="text" id="genre" name="genre" class="form-control col-12 col-md-8 mb-md-2" value="<?= $_POST['genre'] ?? '' ?>" placeholder="Entrez le genre de musique du disque">
<span class="<?= isset($resultat['genre']) ? 'alert alert-danger' : '' ?> text-center"><?= $resultat['genre'] ?? ''; ?></span>
<!--        label du disque-->
<label for="label" class="text-light mt-md-2">Label :</label>
<input type="text" id="label" name="label" class="form-control col-12 col-md-8 mb-md-2" value="<?= $_POST['label'] ?? '' ?>" placeholder="Entrez le label du disque">
<span class="<?= isset($resultat['label']) ? 'alert alert-danger' : '' ?> text-center"><?= $resultat['label'] ?? ''; ?></span>
<!--        prix du disque-->
<label for="prix" class="text-light mt-md-2">Price :</label>
<input type="text" id="prix" name="prix" class="form-control col-12 col-md-8 mb-md-2" value="<?= $_POST['prix'] ?? '' ?>" placeholder="Entrez le prix du disque">
<span class="<?= isset($resultat['prix']) ? 'alert alert-danger' : '' ?> text-center"><?= $resultat['prix'] ?? ''; ?></span>
<!--        image du disque-->
<label for="image" class="text-light mt-md-2">Picture :</label>
<input type="file" id="image" name="image" accept="image/*">
<span class="<?= isset($resultat['image']) ? 'alert alert-danger' : '' ?> text-center"><?= $resultat['image'] ?? ''; ?></span>
<div class="mt-3">
    <!--            boutons envoyer et retour-->
    <button type="submit" class="btn btn-success" name="envoi" id="envoi">Envoyer</button>
    <a href="/disques/listeDisques" class="btn btn-info">Retour</a>
</div>
</form>

<?php
}elseif($aff===true){
    ?>

    <div class="d-flex flex-column align-items-center">
        <h1 class="alert alert-success"> Bien ajouté à la bdd</h1>
        <a href="/disques/listeDisques" class="btn btn-info">Retour à la liste des disques</a>
        <p>Vous allez être redirigé dans <span id="compteur">5</span> secondes...</p>
    </div>
    <!--    appel du script du compteur-->
    <script src="/assets/javaScript/scripts.js"></script>
    <?php
    header("refresh: 5; url=/disques/listeDisques");
}
    ?>
