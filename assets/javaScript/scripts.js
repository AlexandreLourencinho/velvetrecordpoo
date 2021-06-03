// récupère l'id du bouton envoi
const form = document.getElementById('envoi');

//fonction pour le compteur
form.onclick = setTimeout(setInterval(function () {
        let compt = document.getElementById('compteur').innerText;
        compt = parseInt(compt, 10);
        console.log(compt);
        compt--;
        document.getElementById('compteur').innerHTML = compt;
    },
    1000), 1000);

// récupère l'id de l'envoi du formulaire de suppression
const supform = document.getElementById('supprform');

// fenetre confirm sur l'appui de supprimer
supform.onsubmit = function () {
    return confirm('Êtes vous sûr de vouloir supprimer ce disque? la suppression est irréversible.');
}
