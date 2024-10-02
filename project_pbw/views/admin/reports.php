<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="/project_pbw/css/style.css">
</head>
<body>
    <h1>Reports</h1>
    <h2>Most Popular Books</h2>
    <ul>
        <?php foreach ($popularBooks as $book): ?>
            <li><?php echo $book['title'] . " - Borrowed " . $book['borrow_count'] . " times"; ?></li>
        <?php endforeach; ?>
    </ul>
    <h2>Overdue Books</h2>
    <ul>
        <?php foreach ($overdueBooks as $book): ?>
            <li><?php echo $book['title'] . " by " . $book['username'] . " - Due on " . $book['due_date']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
