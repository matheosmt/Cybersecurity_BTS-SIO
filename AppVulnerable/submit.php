<?php
// submit.php
$host = '127.0.0.1';
$db = 'tp_comments';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$content = $_POST['content'] ?? '';
try {
$pdo = new PDO($dsn, $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "INSERT INTO comments (content) VALUES ('" . $content . "')";
$pdo->exec($sql);
header('Location: comments.php');
exit;
} catch (PDOException $e) {
echo "Erreur SQL : " . $e->getMessage();
}
} else {
header('Location: index.html');
exit;
}
