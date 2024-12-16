<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include 'db.php';

// Initialize variables for form values and error messages
$title = $author = $year = "";
$title_err = $author_err = $year_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate title
    if (empty(trim($_POST["title"]))) {
        $title_err = "Please enter a title.";
    } else {
        $title = trim($_POST["title"]);
    }

    // Validate author
    if (empty(trim($_POST["author"]))) {
        $author_err = "Please enter the author's name.";
    } else {
        $author = trim($_POST["author"]);
    }

    // Validate year
    if (empty(trim($_POST["year"]))) {
        $year_err = "Please enter the publication year.";
    } elseif (!is_numeric($_POST["year"])) {
        $year_err = "Please enter a valid year.";
    } else {
        $year = trim($_POST["year"]);
    }

    // Check for errors before inserting into database
    if (empty($title_err) && empty($author_err) && empty($year_err)) {
        $sql = "INSERT INTO books (title, author, year) VALUES (:title, :author, :year)";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':title' => $title,
                ':author' => $author,
                ':year' => $year,
            ]);

            // Redirect to books page after successful addition
            header("Location: book.php");
            exit;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Add a New Book</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Book Title</label>
            <input type="text" name="title" id="title" class="form-control <?= !empty($title_err) ? 'is-invalid' : ''; ?>" value="<?= htmlspecialchars($title); ?>">
            <div class="invalid-feedback"><?= $title_err; ?></div>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" name="author" id="author" class="form-control <?= !empty($author_err) ? 'is-invalid' : ''; ?>" value="<?= htmlspecialchars($author); ?>">
            <div class="invalid-feedback"><?= $author_err; ?></div>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Year Published</label>
            <input type="text" name="year" id="year" class="form-control <?= !empty($year_err) ? 'is-invalid' : ''; ?>" value="<?= htmlspecialchars($year); ?>">
            <div class="invalid-feedback"><?= $year_err; ?></div>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary">Add Book</button>
            <a href="book.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>
