<?php
var_dump($disques);
?>
<div class="d-flex justify-content-center">
<div class="table-responsive">
    <table class="table table-dark table-stripped table-hover col-10">
        <thead>
        <th>id</th>
        <th>titre</th>
        <th>image</th>
        <th>annee</th>
        <th>label</th>
        <th>genre</th>
        <th>artiste</th>
        <th>Actions</th>
        </thead>
        <tbody>
        <?php
        foreach ($disques as $disque){
        ?>
        <tr>
            <td><?= $disque->disc_id ?></td>
            <td><?= $disque->disc_title ?></td>
            <td><img src="../../assets/images/<?= $disque->disc_picture ?>" alt=""></td>
            <td><?= $disque->disc_year ?></td>
            <td><?= $disque->disc_label ?></td>
            <td><?= $disque->disc_genre ?></td>
            <td><?= $disque->artist_name ?></td>
            <td><a href="detailsDisques/<?= $disque->disc_id?>" class="btn btn-info">Détails</a></td>
        </tr>
        <?php
        } ?>
        </tbody>
    </table>
</div>
</div>