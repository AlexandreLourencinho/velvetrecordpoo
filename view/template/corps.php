<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/CSS/style.css">
    <!--    lien de mon potifavicon-->
    <link rel="icon" type="image/x-icon" sizes="16x16" href="/favicon.ico">
    <title><?= $titre ?></title>
</head>
<body>
<header class="sticky-top">
    <!--    navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid ">
            <a class="navbar-brand text-title" href="#"><u><b>Velvet Record</b></u></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mr-1" id="navbarNav">
                <ul class="navbar-nav">
                    <li>
                        <a class="nav-link text-light" role="button" href="/" title="lien vers l'accueil de Velvet Record"><i
                                    class="fas fa-home"></i> Accueil</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li>
                        <a class="nav-link text-light" href="/disques/listeDisques"
                           title="Accès à la liste des diques"><i class="fas fa-compact-disc"></i> liste des disques</a>
                    </li>
                </ul>
                    <ul class="navbar-nav">
                        <li>
                            <a class="nav-link text-light" href="/utilisateurs/formulaire_connexion"
                               title="Accès à la liste des diques"><i class="fas fa-sign-in-alt"></i> Se connecter</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li>
                            <a class="nav-link text-light" href="/utilisateurs/creer_compte"
                               title="Accès à la liste des diques"><i class="fas fa-user-circle"></i> Créer un
                                compte</a>
                        </li>
                    </ul>
                </div>
        </div>
    </nav>
</header>
<!--les container et d-flex-->
<!--<div class="container">-->
    <div class="d-md-flex justify-content-center">



<?= $contenu ?>

        <!--fermeture des div ouvertes dans le header-->
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8"
        crossorigin="anonymous"></script>
<!--colonne 1-->
<footer class="d-flex col-12 justify-content-between bg-dark bleh ml-1">
    <div class="d-flex flex-column col-6 col-md-4 border border-dark">
        <p class="h4"><u class=" footitre text-light">Copyright Lourencinho Alexandre ©</u></p>
        <p class="text-light">Ce travail a été réalisé dans le cadre de l'évaluation consacré au php de la formation
            de </p>
        <p class="text-light">concepteur
            développeur d'application à l'AFPA d'Amiens. Toute reproduction non </p>
        <p class="text-light">consentie est strictement interdite.</p>
    </div>
    <!--    colonne 2 - liens de contact-->
    <div class="d-flex flex-column col-6 col-md-4 border border-dark">
        <p class="h4 text-light text-center"><u>Liens de contact</u></p>
        <p class="text-light text-center">Vous pouvez me contacter par les moyens suivants :</p>
        <ul>
            <li><a target="_blank" href="https://github.com/AlexandreLourencinho"
                   title="Lien vers le github de Lourencinho Alexandre" class="text-info">Mon github</a></li>
            <li><a target="_blank" href="https://discord.gg/kFWCtWQDMf"
                   title="lien vers le discord de Lourencinho Alexandre" class="text-info">Mon discord</a></li>
            <li>
                <a href="mailto:lourencinho.alexandre@protonmail.com?subject=Contact%20depuis%20votre%20évaluation%20php%20de%20CDA"
                   title="lien pour envoyer un mail a Lourencinho Alexandre" class="text-info">M'envoyer un mail</a>
            </li>
            <li><a target="_blank" href="#" class="text-info" title="lien vers le linkedin de Lourencinho Alexandre">Mon
                    linkedin</a></li>
        </ul>
    </div>
    <!--    colonne trois, sites partenaires ^^'-->
    <div class="d-flex flex-column col-4 border border-dark d-none d-md-block">
        <p class="h4"><u class="footitre text-light">Sites partenaires</u></p>
        <p class="text-light">Les liens vers nos sites affiliés.</p>
        <ul>
            <li class=" d-md-block d-none"><a target="_blank" href="https://ncode.amorce.org/" class="text-info"
                                              title="lien de la plate-forme support utilisée">ncode amorce</a></li>
            <li class="d-md-block d-none"><a target="_blank" href="https://www.php.net/manual/fr/" class="text-info"
                                             title="Lien vers la doc php">php.net aka lisez la doc!</a></li>
            <li class="d-md-block d-none"><a target="_blank" href="https://www.afpa.fr"
                                             title="Lien vers le site de l'afpa" class="text-info">afpa.fr, l'organisme
                    dispensant cette formation</a></li>
        </ul>
    </div>
</footer>
</body>
</html>