
<form action="#"
      class="form-group col-12 col-md-10 d-flex flex-column align-items-start justify-content-start mb-3" method="post"
      enctype="multipart/form-data" id="formmodif">
    <p class="h3 text-center text-light">Modification de <?= $disqueDetail->disc_title ?> de <?= $disqueDetail->artist_name ?></p>
    <div class="col-12 d-flex flex-md-row flex-column">
        <div class="col-12 col-md-5 me-2">
            <!--                titre-->
            <p><label for="detailsTitre" class="text-light">Title :</label></p>
            <input type="text" class="form-control col-12" id="detailsTitre"
                   value="<?= $_POST ? $_POST['titre'] : $disqueDetail->disc_title ?>" name="titre">
            <p class="<?= isset($verifform['titre']) ? 'alert alert-danger' : '' ?> text-center"><?= $verifform['titre'] ?? ''; ?></p>
        </div>
        <!--            artistes-->
        <div class="col-12 col-md-5 ms-md-2">
            <p><label for="artiste" class="text-light">Artist :</label></p>
            <select class="form-select col-12" aria-label="Default select example" id="artiste" name="artiste">
                <option disabled>- Séléctionnez un artiste -</option>
                <?php
                foreach ($artistes as $artiste) {

                    ?>
                    <option <?= $disqueDetail->artist_id == $artiste->artist_id ? "selected" : ""; ?>
                        value="<?= $artiste->artist_id ?>">
                        <?= $artiste->artist_name ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <!--        année du disque-->
    <div class="col-12 d-flex flex-md-row flex-column">
        <div class="col-12 col-md-5 me-2">
            <p><label for="detailsAnnee" class="text-light">Year :</label></p>
            <input name="annee" type="text" class="form-control col-6" id="detailsAnnee"
                   value="<?= $_POST ? $_POST['annee'] : $disqueDetail->disc_year ?>">
            <p class="<?= isset($verifform['annee']) ? 'alert alert-danger' : '' ?> text-center"><?= $verifform['annee'] ?? ''; ?></p>
        </div>
        <!--            genre du disque-->
        <div class="col-12 col-md-5 ms-md-2">
            <p><label for="detailsGenre" class="text-light">Genre :</label></p>
            <input name="genre" type="text" class="form-control col-6" id="detailsGenre"
                   value="<?= $_POST ? $_POST['genre'] : $disqueDetail->disc_genre ?>">
            <p class="<?= isset($verifform['genre']) ? 'alert alert-danger' : '' ?> text-center"><?= $verifform['genre'] ?? ''; ?></p>
        </div>
    </div>
    <!--        label du disque-->
    <div class="col-12 d-flex flex-md-row flex-column">
        <div class="col-12 col-md-5 me-2">
            <p><label for="detailsLabel" class="text-light">Label :</label></p>
            <input name="label" type="text" class="form-control col-6" id="detailsLabel"
                   value="<?= $_POST ? $_POST['label'] : $disqueDetail->disc_label ?>">
            <p class="<?= isset($verifform['label']) ? 'alert alert-danger' : '' ?> text-center"><?= $verifform['label'] ?? ''; ?></p>
        </div>
        <!--            prix du disque-->
        <div class="col-12 col-md-5 ms-md-2">
            <p><label for="detailsPrix" class="text-light">Price :</label></p>
            <input name="prix" type="text" class="form-control col-6" id="detailsPrix"
                   value="<?= $_POST ? $_POST['prix'] : $disqueDetail->disc_price ?>">
            <p class="<?= isset($verifform['prix']) ? 'alert alert-danger' : '' ?> text-center"><?= $verifform['prix'] ?? ''; ?></p>
        </div>
    </div>
    <!--        image du disque-->
    <div class="d-flex flex-column">
        <label for="detailsImage" class="mt-2 text-light">Picture</label>
        <img src="/assets/images/<?= $disqueDetail->disc_picture ?>" id="detailsImage" alt="" class="w-50 mb-2 ">
    </div>
    <label for="image"class="text-light">Choisissez une image d'illustration :</label>
    <input type="file" id="image" name="image" accept="image/*" class="text-light">
    <p class="<?= isset($verifform['image']) ? 'alert alert-danger' : '' ?> text-center"><?= $verifform['image'] ?? ''; ?></p>
    <!--        boutons submit retour aux détails etc-->
    <div class="justify-content-center col">
        <button type="submit" name="envoi" id="envoi" class="btn btn-outline-warning" title="confirmer la modification de <?= $disqueDetail->disc_title ?>">Modifier</button>
        <input type="hidden" value="<?= $disqueDetail->disc_id ?>" name="disc_id">
        <a href="/disques/detailsDisques/<?= $disqueDetail->disc_id ?>" class="btn btn-outline-info" title="retour aux détails du disque <?= $disqueDetail->disc_title ?>">Retour aux
            détails du disque</a>
        <a href="/disques/listeDisques" class="btn btn-outline-light" title="retour à la liste des disques">Retour à la liste des disques</a>
    </div>
</form>