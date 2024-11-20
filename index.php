<?php
include "koneksi.php";  // Mengimpor kelas Database

// Membuat objek dari kelas Database
$db = new Database();
$connection = $db->getConnection(); // Mendapatkan objek koneksi

// Query untuk mengambil semua data barang
$query = "SELECT * FROM barang";

// Menjalankan query dengan metode query() dari kelas Database
$result = $db->query($query);

// Mengecek apakah query berhasil
if (!$result) {
    die("Query gagal: " . $connection->error);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir NovMart</title>
    <link rel="stylesheet" href="sidebar.css">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="sidebar-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h1 class="sidebar-title">System Kasir NovMart</h1>
            </div>
            <div class="menu-container">
                <h2 class="menu-title">Dashboard</h2>
                <ul class="menu-list">
                    <li class="menu-item">
                        <a href="tampil_transaksi.php" target="content-frame">
                            <i class="fas fa-exchange-alt"></i>
                             Bukti Transaksi 
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="tambah_transaksi.php" target="content-frame">
                            <i class="fas fa-plus-circle"></i>
                             Transaksi Customer
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="tampil_barang.php" target="content-frame">
                            <i class="fas fa-box"></i>
                             Daftar Barang Masuk
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="laporan_penjualan.php" target="content-frame">
                            <i class="fas fa-chart-bar"></i>
                             Laporan Penjualan
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-box">
                <iframe name="content-frame" frameborder="0" width="100%" height="600px"></iframe>
            </div>
        </div>
    </div>

    <script>
        // Add active class to current menu item
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Set default content
        window.onload = function() {
            document.querySelector('iframe[name="content-frame"]').src = 'tampil_barang.php';
            document.querySelector('a[href="tampil_barang.php"]').parentElement.classList.add('active');
        };
    </script>
</body>
</html>
