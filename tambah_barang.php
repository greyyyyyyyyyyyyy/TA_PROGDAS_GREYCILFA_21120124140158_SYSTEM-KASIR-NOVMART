<?php
include 'koneksi.php';

// Membuat objek dari kelas Database
$db = new Database();
$connection = $db->getConnection(); // Mendapatkan objek koneksi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tangkap data dari form dan lakukan sanitasi input
    $nama_barang = htmlspecialchars(trim($_POST['nama_barang'])); // Sanitasi input
    $harga = (float) $_POST['harga']; // Pastikan menjadi float untuk harga
    $stok = (int) $_POST['stok']; // Pastikan menjadi integer untuk stok

    // Query untuk menambahkan barang ke dalam database
    $query = "INSERT INTO barang (nama_barang, harga, Stock) VALUES ('$nama_barang', '$harga', '$stok')";

    // Menjalankan query dengan metode query() dari objek Database
    if ($db->query($query)) {
        // Redirect ke halaman daftar barang setelah berhasil menambahkan
        header("Location: tampil_barang.php");
        exit;
    } else {
        echo "Error: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="sidebar.css"> <!-- Menghubungkan file CSS Sidebar -->
</head>
<body>
    <div class="sidebar-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2 class="sidebar-title">Menu Kasir</h2>
            </div>
            <div class="menu-container">
                <ul class="menu-list">
                    <li class="menu-item">
                        <a href="daftar_barang.php">Daftar Barang</a>
                    </li>
                    <!-- Tambahkan menu lainnya sesuai kebutuhan -->
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-box">
                <h2>Tambah Barang</h2>
                <form method="POST" action="tambah_barang.php" class="form-tambah-barang">
                    <label for="nama_barang">Nama Barang:</label>
                    <input type="text" name="nama_barang" required><br><br>

                    <label for="harga">Harga:</label>
                    <input type="number" step="0.01" name="harga" required><br><br>

                    <label for="stok">Stock:</label>
                    <input type="number" name="stok" required><br><br>

                    <button type="submit" class="btn-submit">Tambah Barang</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
