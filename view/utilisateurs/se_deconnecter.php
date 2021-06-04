<?php
if(!empty($_SESSION)){

if (ini_get("session.use_cookies"))
{
setcookie(session_name(), '', time()-42000);
}
//    var_dump($_SESSION);
    unset($_SESSION);
session_destroy();
?>
        <div class="d-flex flex-column">
<h1>Vous êtes bien déconnecté !</h1>
<h2 class="text-center">redirection...</h2>
        </div>
<?php
    header("refresh: 2; url=/disques/listeDisques");
}
?>

