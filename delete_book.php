<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include 'db.php';

// Check if the PDO connection is established
if (!isset($pdo)) {
    die("Error: Database connection is not established.");
}

// Check if the ID is provided via POST or GET
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];
} elseif (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die("Error: No ID provided for deletion.");
}

try {
    // Fetch record details
    $fetchSql = "SELECT title, author, year FROM books WHERE id = :id";
    $fetchStmt = $pdo->prepare($fetchSql);
    $fetchStmt->bindParam(':id', $id, PDO::PARAM_INT);
    $fetchStmt->execute();

    if ($fetchStmt->rowCount() === 1) {
        die("Error: Record with ID $id not found.");
    }

    // Fetch record data
    $record = $fetchStmt->fetch(PDO::FETCH_ASSOC);

    // Confirm deletion
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
        // Prepare the DELETE statement
        $deleteSql = "DELETE FROM books WHERE id = :id";
        $deleteStmt = $pdo->prepare($deleteSql);
        $deleteStmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($deleteStmt->execute()) {
            echo "Record with ID $id (Title: {$record['title']}, Author: {$record['author']}, Year: {$record['year']}) was deleted successfully.";
            header("Location: book.php");
            exit;  // Make sure to
        } else {
            echo "Error: Could not delete the record.";
        }
        exit;
    }
} catch (PDOException $e) {
    die("ERROR: Could not execute query. " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Delete Record</h2>
                    <div class="alert alert-danger">
                        <p>Are you sure you want to delete the following record?</p>
                        <ul>
                            <li><strong>Title:</strong> <?= htmlspecialchars($record['title']) ?></li>
                            <li><strong>Author:</strong> <?= htmlspecialchars($record['author']) ?></li>
                            <li><strong>Year:</strong> <?= htmlspecialchars($record['year']) ?></li>
                        </ul>
                        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                            <input type="hidden" name="confirm" value="yes">
                            <button href="book.php" type="submit" class="btn btn-danger">Yes, Delete</button>
                            <a href="book.php" class="btn btn-secondary">No, Cancel</a>
                        </form>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
