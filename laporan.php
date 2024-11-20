<?php
include 'koneksi.php';

// Membuat objek dari kelas Database
$db = new Database();
$connection = $db->getConnection(); // Mendapatkan objek koneksi

// Mendapatkan tanggal mulai dan tanggal selesai
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Menyusun query dasar
$query_laporan = "SELECT transaksi.id_transaksi, barang.nama_barang, transaksi.jumlah, transaksi.total_harga, transaksi.tanggal
                  FROM transaksi 
                  JOIN barang ON transaksi.id_barang = barang.id_barang";

// Menambahkan filter tanggal jika tersedia
if ($start_date && $end_date) {
    $query_laporan .= " WHERE transaksi.tanggal BETWEEN '$start_date' AND '$end_date'";
}

// Menjalankan query menggunakan metode query() dari objek Database
$result_laporan = $db->query($query_laporan);

// Menangani error query
if (!$result_laporan) {
    die("Query gagal: " . $connection->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Laporan Penjualan</h1>

    <!-- Form Filter Tanggal -->
    <form method="GET" action="laporan_penjualan.php">
        <label for="start_date">Tanggal Mulai:</label>
        <input type="date" name="start_date" value="<?php echo htmlspecialchars($start_date); ?>" required>
        <label for="end_date">Tanggal Selesai:</label>
        <input type="date" name="end_date" value="<?php echo htmlspecialchars($end_date); ?>" required>
        <button type="submit">Tampilkan</button>
    </form>

    <!-- Tabel Laporan Penjualan -->
    <table border="1">
        <tr>
            <th>ID Transaksi</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Tanggal</th>
        </tr>

        <?php if ($result_laporan->num_rows > 0): ?>
            <?php while ($row = $result_laporan->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id_transaksi']); ?></td>
                    <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                    <td><?php echo htmlspecialchars($row['jumlah']); ?></td>
                    <td><?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                    <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Belum ada transaksi.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
