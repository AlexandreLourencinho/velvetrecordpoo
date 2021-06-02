<?php
//echo 'prout';
//var_dump($details);
?>
    <!--début du formulaire-->
    <form action="#" class="form-group col-12 col-md-10 d-flex flex-column align-items-start justify-content-start">

        <p class="h3 text-light">Détails du disque <?= $details->disc_title ?> de <?= $details->artist_name ?> </p>
        <!--        titre   -->
        <div class="col-12 d-flex flex-md-row flex-column mb-2">
            <div class="col-12 col-md-4 me-2">
                <p><label for="detailsTitre" class="text-light">Title :</label></p>
                <input type="text" class="form-control col-12 col-md-6" id="detailsTitre"
                       value="<?= $details->disc_title ?>"
                       disabled>
            </div>
            <!--            nom de l'artiste-->
            <div class="col-12 col-md-4 ms-md-2">
                <p><label for="detailsArtiste" class="text-light"> Artist :</label></p>
                <input type="text" class="form-control col-12 col-md-6" id="detailsArtiste"
                       value="<?= $details->artist_name ?>"
                       disabled>
            </div>
        </div>
        <!--        année du disque-->
        <div class="col-12 d-flex flex-column flex-md-row">
            <div class="col-12 col-md-4 me-2">
                <p><label for="detailsAnnee" class="text-light">Year :</label></p>
                <input type="text" class="form-control col-12 col-md-6" id="detailsAnnee"
                       value="<?= $details->disc_year ?>"
                       disabled>
            </div>
            <!--            genre du disque-->
            <div class="col-12 col-md-4 ms-md-2">
                <p><label for="detailsGenre" class="text-light">Genre :</label></p>
                <input type="text" class="form-control col-12 col-md-6" id="detailsGenre"
                       value="<?= $details->disc_genre ?>"
                       disabled>
            </div>
        </div>
        <!--        label du disque-->
        <div class="col-12 d-flex flex-column flex-md-row">
            <div class="col-12 col-md-4 me-2">
                <p><label for="detailsLabel" class="text-light">Label :</label></p>
                <input type="text" class="form-control col-12 col-md-6" id="detailsLabel"
                       value="<?= $details->disc_label ?>"
                       disabled>
            </div>
            <!--            prix du disque-->
            <div class="col-12 col-md-4 ms-md-2">
                <p><label for="detailsPrix" class="text-light">Price :</label></p>
                <input type="text" class="form-control col-12 col-md-6" id="detailsPrix"
                       value="<?= $details->disc_price ?>"
                       disabled>
            </div>
        </div>
        <!--        image du disque-->
        <div class="d-flex flex-column">
            <label for="detailsImage" class="mt-2 text-light">Picture</label>
            <img src="../../assets/images/<?= $details->disc_picture ?>" id="detailsImage"
                 title="pochette du disque <?= $details->disc_title ?> de <?= $details->artist_name ?>."
                 alt="pochette du disque <?= $details->disc_title ?> de <?= $details->artist_name ?>."
                 class="w-50 mb-2 ">
        </div>
        <div class="d-flex flex-row mt-2">
            <!--            liens vers les pages modifier ou supprimer (et retour ) -->
            <a href="/disques/form_modif/<?= $details->disc_id ?>" class="btn btn-outline-warning me-1"
               title="retour à la liste des disques">modifier</a>
            <a href="/disques/supprimer_disque/<?= $details->disc_id ?>" class="btn btn-danger ms-1 me-1"
               title="retour à la liste des disques">supprimer</a>
            <a href="/disques/listeDisques" class="btn btn-outline-info ms-1"
               title="retour à la liste des disques">Retour</a>
        </div>
    </form>
