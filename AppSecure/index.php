// Creation of a token
<?php
session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['csrf_token'];
?>

// User form
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Poster un commentaire (vulnérable)</title>
    </head>
    <body>
        <h1>Poster un commentaire</h1>

        <form method="post" action="submit.php">
            <label>Message<br>
                <textarea name="content" rows="5" cols="60" required></textarea>
            </label>
            // Token stored in session
            <input type="hidden" name="csrf_token" value="<?= $token ?>">
            <br>
            <button type="submit">Envoyer</button>
        </form>

        <p>Après envoi, vous serez redirigé vers la page qui affiche tous les commentaires.</p>
    </body>
</html>