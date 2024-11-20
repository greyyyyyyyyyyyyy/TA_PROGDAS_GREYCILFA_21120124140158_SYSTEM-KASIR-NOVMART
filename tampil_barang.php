<?php
include 'koneksi.php'; // Menghubungkan ke database

$db = new Database();
$connection = $db->getConnection();

// Query untuk mendapatkan data barang
$query = "SELECT * FROM barang";

// Menjalankan query untuk mendapatkan data barang
$result = $connection->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <link rel="stylesheet" href="sidebar.css"> <!-- Tautkan file CSS Sidebar -->
</head>
<body>
    <div class="sidebar-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2 class="sidebar-title">Menu</h2> <!-- Mengubah nama menu -->
            </div>
            <div class="menu-container">
                <ul class="menu-list">
                    <li class="menu-item active">
                        <a href="tampilbarang.php">Daftar Barang</a> <!-- Mengarah ke halaman daftar barang -->
                    </li>
                    <li class="menu-item dropdown">
                        <a href="javascript:void(0)">Tambah Barang</a> <!-- Dropdown toggle -->
                        <ul class="dropdown-menu">
                            <li><a href="tambah_barang.php">Tambah Barang Baru</a></li> <!-- Link untuk tambah barang -->
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-box">
                <h1>Daftar Barang</h1>
                <a href="tambah_barang.php" class="btn-tambah-barang">Tambah Barang</a>
                <table class="table-laporan barang-table"> <!-- Menggunakan kelas barang-table -->
                    <thead>
                        <tr>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Cek apakah ada data barang
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . htmlspecialchars($row['id_barang']) . "</td>
                                        <td>" . htmlspecialchars($row['nama_barang']) . "</td>
                                        <td>" . number_format($row['harga'], 0, ',', '.') . "</td>
                                        <td>" . htmlspecialchars($row['Stock']) . "</td>
                                        <td>
                                            <a href='edit.php?id=" . urlencode($row['id_barang']) . "'>Edit</a> |
                                            <a href='hapus.php?id=" . urlencode($row['id_barang']) . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus barang ini?\")'>Hapus</a>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Tidak ada data barang.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
