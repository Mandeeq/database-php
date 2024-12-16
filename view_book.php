<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include 'db.php';

// Check if the `id` is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch book details from the database
    $sql = "SELECT id, title, author, year FROM books WHERE id = :id";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$book) {
            die("Book not found.");
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    die("Invalid book ID.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Book Details</h1>
    <div class="card">
        <div class="card-header">
            <h2><?= htmlspecialchars($book['title']); ?></h2>
        </div>
        <div class="card-body">
            <p><strong>Author:</strong> <?= htmlspecialchars($book['author']); ?></p>
            <p><strong>Year Published:</strong> <?= htmlspecialchars($book['year']); ?></p>
        </div>
        <div class="card-footer text-end">
            <a href="book.php" class="btn btn-secondary">Back to Books</a>
        </div>
    </div>
</div>
</body>
</html>
