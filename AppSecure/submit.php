File to store form data in the database
<?php

$host = '127.0.0.1';
$db = 'DB_name';
$user = 'user'; // Create a secure user to access the database - Never log in as root
$pass = 'p@ssword'; // Use the password created for this user
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'] ?? '';

    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // If SQL queries are not prepared, there will be an SQL vulnerability
        $sql = "INSERT INTO comments (content) VALUES (:content)"; // The SQL query itself
        $stmt = $pdo->prepare($sql); // The query is prepared
        // The query is executed — the SQL vulnerability is no longer present
        $stmt->execute([
            ':content' => $content
        ]);

        header('Location: comments.php');
        exit;
    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
    }
} else {
    header('Location: index.html');
    exit;
}
