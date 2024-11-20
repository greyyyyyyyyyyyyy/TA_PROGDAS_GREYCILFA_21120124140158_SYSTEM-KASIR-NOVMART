<?php
include 'koneksi.php';

// Membuat objek dari kelas Database
$db = new Database();
$connection = $db->getConnection(); // Mendapatkan objek koneksi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tangkap data dari form dan lakukan sanitasi input
    $id_barang = (int) $_POST['id_barang']; // Pastikan menjadi integer
    $jumlah = (int) $_POST['jumlah']; // Pastikan menjadi integer
    $total_harga = (float) $_POST['total_harga']; // Pastikan menjadi float untuk harga

    // Query untuk memasukkan data transaksi
    $query = "INSERT INTO transaksi (id_barang, jumlah, total_harga) VALUES ('$id_barang', '$jumlah', '$total_harga')";

    // Menjalankan query dengan metode query() dari objek Database
    if ($db->query($query)) {
        echo "Transaksi berhasil ditambahkan!";
    } else {
        echo "Error: " . $connection->error;
    }
}
?>

<!-- Form untuk menambah transaksi -->
<form method="POST" action="tambah_transaksi.php">
    <label for="id_barang">ID Barang:</label>
    <input type="number" name="id_barang" required><br><br>

    <label for="jumlah">Jumlah:</label>
    <input type="number" name="jumlah" required><br><br>

    <label for="total_harga">Total Harga:</label>
    <input type="number" step="0.01" name="total_harga" required><br><br>

    <button type="submit">Tambah Transaksi</button>
</form>
