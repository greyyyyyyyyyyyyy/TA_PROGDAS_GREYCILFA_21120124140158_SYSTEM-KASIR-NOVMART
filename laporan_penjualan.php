<?php
include 'koneksi.php';

// Membuat objek dari kelas Database
$db = new Database();
$connection = $db->getConnection(); // Mendapatkan objek koneksi

$tanggal_mulai = $_GET['tanggal_mulai'] ?? '';
$tanggal_selesai = $_GET['tanggal_selesai'] ?? '';

// Menyusun query dasar
$query = "SELECT t.id_transaksi, b.nama_barang, t.jumlah, t.total_harga, t.tanggal 
          FROM transaksi t 
          JOIN barang b ON t.id_barang = b.id_barang";

// Menambahkan filter tanggal jika tersedia
if (!empty($tanggal_mulai) && !empty($tanggal_selesai)) {
    $query .= " WHERE t.tanggal BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'";
}

// Menjalankan query menggunakan metode query() dari objek Database
$result = $db->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="sidebar.css">
</head>
<body>
    <div class="sidebar-container">
        <!-- Sidebar Section -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h1 class="sidebar-title">Kasir System</h1>
            </div>
            <div class="menu-container">
                <div class="menu-title">Menu</div>
                <ul class="menu-list">
                    <!-- Menu items -->
                    <li class="menu-item">
                        <a href="laporan_penjualan.php">
                            <i class="fas fa-chart-line"></i> Laporan Penjualan
                        </a>
                    </li>
                    <!-- Add more menu items as necessary -->
                </ul>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="main-content">
            <div class="content-box">
                <h2>Laporan Penjualan</h2>
                <form method="GET" action="laporan_penjualan.php" class="form-laporan">
                    <label for="tanggal_mulai">Tanggal Mulai:</label>
                    <input type="date" name="tanggal_mulai" value="<?php echo htmlspecialchars($tanggal_mulai); ?>" required>
                    <label for="tanggal_selesai">Tanggal Selesai:</label>
                    <input type="date" name="tanggal_selesai" value="<?php echo htmlspecialchars($tanggal_selesai); ?>" required>
                    <button type="submit">Tampilkan</button>
                </form>

                <table class="table-laporan">
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Tanggal</th>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id_transaksi']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                            <td><?php echo htmlspecialchars($row['jumlah']); ?></td>
                            <td>Rp<?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                            <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
