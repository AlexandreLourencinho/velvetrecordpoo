
<!-- pas sous forme de formulaire -->
<div class="d-flex flex-wrap justify-content-start m-0 col-12 col-md-10">
    <div class="col-11 d-flex align-items-center ms-1 me-5">
        <!--        nombre de disques-->
        <h1 class="me-auto text-light"><b>Liste des disques (<?= $nombre->compteur ?>)</b></h1>
        <a class="btn btn-outline-light" href="/disques/form_ajout" title="ajouter un disque à la base de données">Ajouter</a>
    </div>
    <?php
    foreach ($disques as $disque) {
        // parcours du tableau d'objets des disques
        ?>
        <div class="col-12 col-md-6 d-flex flex-lg-row mb-3 bla align-items-center border border-lg-none">
            <div class="col-6 col-lg-3 pe-2 m-0 h">
                <img src="/assets/images/<?= $disque->disc_picture ?>" alt="pochette du disque <?= $disque->disc_title ?> de <?= $disque->artist_name ?>" title="pochette du disque <?= $disque->disc_title ?> de <?= $disque->artist_name ?>.">
            </div>
            <div class="col-6 col-md-4 d-flex flex-column align-items-center justify-content-center border bg-dark">
                <div class="col-12 mb-lg-4">
                    <span class="h5 text-light"><?= $disque->disc_title ?></span><br>
                    <span class="potitext text-light"><b><?= $disque->artist_name ?></b></span><br>
                    <b><span class="text-light"> Label : </span></b><span class="text-light"><?= $disque->disc_label ?></span><br>
                    <b><span class="text-light"> Year : </span></b><span class="text-light"><?= $disque->disc_year ?></span><br>
                    <b><span class="text-light"> Genre : </span></b><span class="text-light"><?= $disque->disc_genre ?></span><br>
                </div>
                <div class="col-10 mt-2 mt-md-5 mt-lg-3">
                    <a href="/disques/detailsDisques/<?= $disque->disc_id ?>" class="btn btn-outline-info" title="Détails du disque <?= $disque->disc_title ?> de <?= $disque->artist_name ?>.">Détails</a>
                </div>
            </div>

        </div>
        <?php
    }
    ?>
</div>