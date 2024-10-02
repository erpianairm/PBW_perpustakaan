<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=perpustakaan", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection successful!";
} catch (PDOException $e) {
    echo "Connection error: " . $e->getMessage();
}
?>
