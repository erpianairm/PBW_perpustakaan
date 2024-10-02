<?php
require_once 'config/database.php';

class Book {
    private $conn;
    private $table_name = "books";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function addBook($title, $author, $year) {
        $query = "INSERT INTO " . $this->table_name . " (title, author, year) VALUES (:title, :author, :year)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':year', $year);
        return $stmt->execute();
    }

    public function getBooks() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tambahkan fungsi edit dan hapus buku di sini
}
?>
