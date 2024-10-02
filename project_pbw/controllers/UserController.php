<?php
require_once 'models/Book.php';

class UserController {
    private $bookModel;

    public function __construct() {
        $this->bookModel = new Book();
    }

    public function searchBooks($keyword) {
        $books = $this->bookModel->searchBooks($keyword);
        require 'views/user/search_book.php';
    }

    // Tambahkan metode untuk meminjam dan mengembalikan buku di sini
}
?>
