<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <link rel="stylesheet" href="/project_pbw/css/style.css">
</head>
<body>
    <h1>Manage Books</h1>
    <form method="POST" action="/index.php?action=addBook">
        <input type="text" name="title" placeholder="Book Title" required>
        <input type="text" name="author" placeholder="Author" required>
        <input type="number" name="year" placeholder="Year" required>
        <button type="submit">Add Book</button>
    </form>
    <h2>Book List</h2>
    <ul>
        <?php foreach ($books as $book): ?>
            <li><?php echo $book['title'] . " by " . $book['author'] . " (" . $book['year'] . ")"; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
