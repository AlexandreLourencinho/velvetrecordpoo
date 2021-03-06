<?php
if(isset($disqueDetail) AND $disqueDetail===false AND $aff===false  ){
    header('location: /disques/listeDisques');
}
if($aff===false){
    ?>
<form action="/disques/supdisque/<?= $disqueDetail->disc_id ?>"
          class="form-group col-12 col-md-10 d-flex flex-column align-items-start justify-content-start" method="post"
          id="supprform">
        <p class="h3 text-center text-light">Suppression de <?= $disqueDetail->disc_title ?> de <?= $disqueDetail->artist_name ?></p>
        <div class="col-12 d-flex flex-md-row flex-column mb-2">
            <div class="col-12 col-md-4 me-2">
                <p><label for="detailsTitre" class="text-light fondopac">Title :</label></p>
                <input type="text" class="form-control col-6" id="detailsTitre" value="<?= $disqueDetail->disc_title ?>"
                       disabled>
            </div>
            <div class="col-12 col-md-4 ms-md-2">
                <p><label for="detailsArtiste" class="text-light fondopac"> Artist :</label></p>
                <input type="text" class="form-control col-6" id="detailsArtiste" value="<?= $disqueDetail->artist_name ?>"
                       disabled>
            </div>
        </div>
        <div class="col-12 d-flex flex-md-row flex-column">
            <div class="col-12 col-md-4 me-2">
                <p><label for="detailsAnnee" class="text-light fondopac">Year :</label></p>
                <input type="text" class="form-control col-6" id="detailsAnnee" value="<?= $disqueDetail->disc_year ?>"
                       disabled>
            </div>
            <div class="col-12 col-md-4 ms-md-2">
                <p><label for="detailsGenre" class="text-light fondopac">Genre :</label></p>
                <input type="text" class="form-control col-6" id="detailsGenre" value="<?= $disqueDetail->disc_genre ?>"
                       disabled>
            </div>
        </div>
        <div class="col-12 d-flex flex-md-row flex-column">
            <div class="col-12 col-md-4 me-2">
                <p><label for="detailsLabel" class="text-light fondopac">Label :</label></p>
                <input type="text" class="form-control col-6" id="detailsLabel" value="<?= $disqueDetail->disc_label ?>"
                       disabled>
            </div>
            <div class="col-12 col-md-4 ms-md-2">
                <p><label for="detailsPrix" class="text-light fondopac">Price :</label></p>
                <input type="text" class="form-control col-6" id="detailsPrix" value="<?= $disqueDetail->disc_price ?>"
                       disabled>
            </div>
        </div>
        <div class="d-flex flex-column">
            <label for="detailsImage" class="mt-2 text-light fondopac">Picture</label>
            <img src="/assets/images/<?= $disqueDetail->disc_picture ?>" id="detailsImage" alt="" class="w-50 mb-2 ">
        </div>
        <div class="justify-content-center col">
            <input type="hidden" value="<?= $disqueDetail->disc_id ?>" name="disc_id" id="disc_id">
            <button type="submit" class="btn btn-danger" id="envoi" name="envoi" title="supprimer le disque <?= $disqueDetail->disc_title ?>">Supprimer</button>
            <a href="/disques/detailsDisques/<?= $disqueDetail->disc_id ?>" class="btn btn-outline-info">Retour aux
                d??tails du disque</a>
            <a href="/disques/listeDisques" class="btn btn-outline-light">Retour ?? la liste des disques</a>
        </div>
    </form>

<?php
}
elseif($aff===true){
    ?>
    <div class="d-flex flex-column align-items-center">
        <h1 class="alert alert-warning">Suppression r??ussie</h1>
        <a href="/disques/listeDisques" class="btn btn-outline-info" title="retournez ?? la liste des disques">Retour ?? la liste des disques</a>
        <p>Vous serez Redirig?? dans <span id="compteur">5</span> secondes...</p>
    </div>

    <script src="/assets/javaScript/scripts.js"></script>
    <?php
    // redirection au bout de 5 secondes
    header("refresh: 5; url=/disques/listeDisques");

}
    ?>
