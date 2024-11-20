<?php
include 'koneksi.php'; // Menghubungkan ke kelas koneksi

// Membuat objek database untuk mendapatkan koneksi
$db = new Database();
$connection = $db->getConnection();

// Query untuk mengambil data transaksi dengan nama barang
$query_transaksi = "SELECT transaksi.id_transaksi, barang.nama_barang, transaksi.jumlah, transaksi.total_harga, transaksi.tanggal
                    FROM transaksi 
                    JOIN barang ON transaksi.id_barang = barang.id_barang";

// Menjalankan query untuk mendapatkan data transaksi
$result_transaksi = $connection->query($query_transaksi);

// Mengecek apakah query berhasil dijalankan
if (!$result_transaksi) {
    die("Query gagal: " . $connection->error);
}
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
    <div class="container">
        <h1 class="title">Laporan Penjualan</h1>

        <h2 class="subtitle">Daftar Transaksi</h2>
        <div class="table-container">
            <table class="transaksi-table">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result_transaksi->num_rows > 0): ?>
                        <?php while ($row = $result_transaksi->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id_transaksi']; ?></td>
                                <td><?php echo $row['nama_barang']; ?></td>
                                <td><?php echo $row['jumlah']; ?></td>
                                <td>Rp<?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                <td><?php echo $row['tanggal']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Belum ada transaksi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
