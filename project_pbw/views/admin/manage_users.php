<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="/project_pbw/css/style.css">
</head>
<body>
    <h1>Manage Users</h1>
    <form method="POST" action="/index.php?action=addUser">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit">Add User</button>
    </form>
    <h2>User List</h2>
    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                <?php echo $user['username'] . " (" . $user['role'] . ")"; ?>
                <a href="/index.php?action=deleteUser&id=<?php echo $user['id']; ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
