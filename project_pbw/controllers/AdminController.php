<?php
require_once 'models/Book.php';

class AdminController {
    private $bookModel;

    public function __construct() {
        $this->bookModel = new Book();
    }

    public function manageBooks() {
        $books = $this->bookModel->getBooks();
        require 'views/admin/manage_books.php';
    }

    public function addBook($title, $author, $year) {
        $this->bookModel->addBook($title, $author, $year);
        header("Location: /index.php?action=manageBooks");
    }

    // Tambahkan fungsi untuk mengelola pengguna dan laporan di sini
}
?>
