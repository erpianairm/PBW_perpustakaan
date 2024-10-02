<?php
// Menghubungkan ke database
try {
    $db = new PDO("mysql:host=localhost;dbname=perpustakaan", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_user = $_POST['id_user'];
        $id_buku = $_POST['id_buku'];
        $tanggal_pinjam = date('Y-m-d');
        $tanggal_jatuh_tempo = date('Y-m-d', strtotime('+7 days')); // 7 hari kemudian

        $sql = "INSERT INTO peminjaman (id_user, id_buku, tanggal_pinjam, tanggal_jatuh_tempo) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id_user, $id_buku, $tanggal_pinjam, $tanggal_jatuh_tempo]);

        echo "Buku berhasil dipinjam!";
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
    <title>Peminjaman Buku</title>
    <link rel="stylesheet" href="/project_pbw/css/style.css">
</head>
<body>
    <h1>Peminjaman Buku</h1>
    <form action="pinjam_buku.php" method="POST">
        <label for="id_user">ID User:</label><br>
        <input type="number" id="id_user" name="id_user" required><br>
        
        <label for="id_buku">ID Buku:</label><br>
        <input type="number" id="id_buku" name="id_buku" required><br>
        
        <input type="submit" value="Pinjam Buku">
    </form>
</body>
</html>
