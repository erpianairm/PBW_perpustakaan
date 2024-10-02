<?php
require_once 'controllers/AdminController.php';
require_once 'controllers/UserController.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

$adminController = new AdminController();

switch($action) {
    case 'manageBooks':
        $adminController->manageBooks();
        break;
    case 'addBook':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminController->addBook($_POST['title'], $_POST['author'], $_POST['year']);
        }
        break;
    // Tambahkan case untuk fitur lain (manajemen pengguna, pelaporan, dsb)
    default:
        echo "Welcome to the Digital Library Management System!";
        break;
}
?>
