
<?php
$dsn = 'mysql:host=localhost;dbname=library;charset=utf8mb4';
$username = 'iman';
$password = 'jamal';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
