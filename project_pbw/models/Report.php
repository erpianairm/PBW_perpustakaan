<?php
require_once 'config/database.php';

class Report {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getPopularBooks() {
        $query = "SELECT books.title, COUNT(*) AS borrow_count 
                  FROM borrows
                  JOIN books ON borrows.book_id = books.id
                  GROUP BY books.id
                  ORDER BY borrow_count DESC
                  LIMIT 10";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOverdueBooks() {
        $query = "SELECT books.title, users.username, borrows.due_date
                  FROM borrows
                  JOIN books ON borrows.book_id = books.id
                  JOIN users ON borrows.user_id = users.id
                  WHERE borrows.due_date < NOW() AND borrows.return_date IS NULL";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
