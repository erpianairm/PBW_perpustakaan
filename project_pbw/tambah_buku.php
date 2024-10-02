<?php
// Menghubungkan ke database
try {
    $db = new PDO("mysql:host=localhost;dbname=perpustakaan", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Ambil data dari form
        $judul = $_POST['judul'];
        $penulis = $_POST['penulis'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $jumlah = $_POST['jumlah'];
        $tersedia = $_POST['tersedia'];

        // SQL untuk menambahkan buku
        $sql = "INSERT INTO buku (judul, penulis, tahun_terbit, jumlah, tersedia) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$judul, $penulis, $tahun_terbit, $jumlah, $tersedia]);

        echo "Buku berhasil ditambahkan!";
    }
} catch (PDOException $e) {
    echo "Connection error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="/project_pbw/css/style.css">
</head>
<body>
    <h1>Tambah Buku</h1>
    <form action="tambah_buku.php" method="POST">
        <label for="judul">Judul:</label><br>
        <input type="text" id="judul" name="judul" required><br>
        
        <label for="penulis">Penulis:</label><br>
        <input type="text" id="penulis" name="penulis" required><br>
        
        <label for="tahun_terbit">Tahun Terbit:</label><br>
        <input type="number" id="tahun_terbit" name="tahun_terbit" required><br>
        
        <label for="jumlah">Jumlah:</label><br>
        <input type="number" id="jumlah" name="jumlah" required><br>
        
        <label for="tersedia">Tersedia:</label><br>
        <input type="number" id="tersedia" name="tersedia" required><br>
        
        <input type="submit" value="Tambah Buku">
    </form>
</body>
</html>
