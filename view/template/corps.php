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
    <title>Document</title>
</head>
<body>
<header class="sticky-top">
    <!--    navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="d-flex flex-row">
            <a class="navbar-brand text-light" href="/index.php" title="lien vers l'accueil de Velvet Record"><i
                        class="fas fa-home"></i> Accueil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mr-1" id="navbarNav">
                <ul class="navbar-nav">
                    <li>
                        <a class="nav-link text-light" href="/view/liste_disques.php"
                           title="Accès à la liste des diques"><i class="fas fa-compact-disc"></i> liste des disques</a>
                    </li>
                </ul>
            </div>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li>
                            <a class="nav-link text-light" href="/view/connexion.php"
                               title="Accès à la liste des diques"><i class="fas fa-sign-in-alt"></i> Se connecter</a>
                        </li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li>
                            <a class="nav-link text-light" href="/view/creation_compte.php"
                               title="Accès à la liste des diques"><i class="fas fa-user-circle"></i> Créer un
                                compte</a>
                        </li>
                    </ul>
                </div>
        </div>
    </nav>
</header>


<?= $contenu ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8"
        crossorigin="anonymous"></script>
</body>
</html>