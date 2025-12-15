<?php

$host = '127.0.0.1';
$db = 'tp_comments';
$user = 'root'; // We do not connect to the database as root
$pass = '';  // We use a secure password
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT id, content, created_at FROM comments ORDER BY created_at
    DESC");
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur SQL : " . $e->getMessage();
    exit;
}
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Commentaires</title>
    </head>
    <body>
        <h1>Commentaires postés</h1>
        <p><a href="index.html">Poster un nouveau commentaire</a></p>

        <?php if (empty($comments)): ?>
            <p>Aucun commentaire pour le moment.</p>
        <?php else: ?>

            <ul>
                <?php foreach ($comments as $c): ?>
                    <! -- XSS vulnerability -- >
                    <li>
                        <div><?= $c['created_at'] ?></div>
                        <div><?= $c['content'] ?></div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </body>
</html>

