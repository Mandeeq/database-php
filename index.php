<?php
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            background-color: #444;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: #fff;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <?php
    // Include the header file
    include 'header.php';
   

    ?>

    <div class="content">
        <h1>Welcome to the Library Management System</h1>
        <p>This system allows you to manage books, track borrowing and returns, and handle user records efficiently.</p>
        <p>Use the navigation bar to explore different sections.</p>
    </div>
    <?php
    // Include the header file
    include 'footer.php';
    ?>

</body>

</html>