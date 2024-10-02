<?php
// Connect to the database
try {
    $db = new PDO("mysql:host=localhost;dbname=perpustakaan", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get data from form
        $id_peminjaman = $_POST['id_peminjaman'];
        $tanggal_kembali = date('Y-m-d');

        // Update the peminjaman record to mark the book as returned
        $sql = "UPDATE peminjaman SET tanggal_kembali = ?, status = 'Dikembalikan' WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$tanggal_kembali, $id_peminjaman]);

        // Increase the 'tersedia' field in the buku table by 1
        $sql = "UPDATE buku b
                JOIN peminjaman p ON b.id = p.id_buku
                SET b.tersedia = b.tersedia + 1
                WHERE p.id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id_peminjaman]);

        echo "Buku berhasil dikembalikan!";
    }

    // Fetch the list of borrowed books (status 'Dipinjam')
    $sql = "SELECT p.id, b.judul, u.nama AS nama_peminjam, p.tanggal_pinjam 
        FROM peminjaman p
        JOIN buku b ON p.id_buku = b.id
        JOIN user u ON p.id_user = u.id
        WHERE p.status = 'dipinjam'";
    $stmt = $db->query($sql);
    $borrowedBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Connection error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian Buku</title>
    <link rel="stylesheet" href="/project_pbw/css/style.css">
</head>
<body>
    <h1>Pengembalian Buku</h1>
    <?php if (!empty($borrowedBooks)): ?>
        <form action="pengembalian_buku.php" method="POST">
            <label for="id_peminjaman">Pilih Buku yang Dikembalikan:</label><br>
            <select name="id_peminjaman" id="id_peminjaman" required>
                <?php foreach ($borrowedBooks as $book): ?>
                    <option value="<?= $book['id'] ?>">
                        <?= $book['judul'] ?> - Dipinjam oleh <?= $book['nama_peminjam'] ?> pada <?= $book['tanggal_pinjam'] ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>
            
            <input type="submit" value="Kembalikan Buku">
        </form>
    <?php else: ?>
        <p>Tidak ada buku yang sedang dipinjam.</p>
    <?php endif; ?>
</body>
</html>
