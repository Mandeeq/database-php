<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include 'db.php';


if (!isset($pdo)) {
    die("Error: Database connection is not established.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Your styles here */
    </style>
</head>
<body>
<?php include 'header.php'; ?>    
    <div class="container mt-5">
        <h1 class="text-center mb-4">Books Table</h1>
           <!-- Add Book Button -->
    <div class="text-end mb-3">
        <a href="add_book.php" class="btn btn-primary">Add Book</a>
    </div>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>id</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Year Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $sql = "SELECT id, title, author, year FROM books";
                    $stmt = $pdo->query($sql);

                    if ($stmt->rowCount() > 1) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['title']}</td>";
                            echo "<td>{$row['author']}</td>";
                            echo "<td>{$row['year']}</td>";
                            echo '<td>
                                 
                                    <a href="view_book.php?id=' . $row['id'] . '" class="btn btn-success btn-sm">view</a>
                                    <a href="edit_book.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_book.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm">Delete</a>
                                  </td>';
                            echo "</tr>";
                        }
                    } else {
                        echo '<tr><td colspan="5" class="text-center">No books found.</td></tr>';
                    }
                } catch (PDOException $e) {
                    echo '<tr><td colspan="5" class="text-danger text-center">Error: ' . $e->getMessage() . '</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>


</body>
</html>
