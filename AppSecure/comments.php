// File to select data from the database and display it to users
<?php

$host = '127.0.0.1';
$db = 'DB_name';
$user = 'user'; // Create a secure user to access the database - Never log in as root
$pass = 'p@assword'; // Use the password created for this user
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
                // If data is displayed without escaping, there will be an XSS vulnerability
                <?php foreach ($comments as $c): ?>
                    // Data is displayed with escaping    
                    <li>
                        <div><?= htmlspecialchars($c['created_at'], ENT_QUOTES, 'UTF-8') ?></div>
                        <div><?= htmlspecialchars($c['content'], ENT_QUOTES, 'UTF-8') ?></div>
                    </li>
                <?php endforeach; ?>
            </ul>

        <?php endif; ?>
    </body>
</html>

