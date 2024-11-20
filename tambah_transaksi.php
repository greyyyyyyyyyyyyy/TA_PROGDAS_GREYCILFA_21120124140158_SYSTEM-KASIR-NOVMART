<?php
include 'koneksi.php';

// Membuat objek Database untuk koneksi
$db = new Database();
$connection = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];

    // Mengambil harga dan stock barang berdasarkan id_barang yang dipilih
    $harga_query = "SELECT harga, Stock FROM barang WHERE id_barang = '$id_barang'"; 
    $harga_result = $db->query($harga_query);
    $harga_data = mysqli_fetch_assoc($harga_result);

    $harga = $harga_data['harga']; // Harga barang
    $stock_tersedia = $harga_data['Stock']; // Stock yang tersedia

    // Cek apakah stock cukup untuk transaksi
    if ($jumlah > $stock_tersedia) {
        echo "Maaf, stock untuk barang ini tidak cukup!";
    } else {
        // Menghitung total harga
        $total_harga = $harga * $jumlah;

        // Query untuk memasukkan data transaksi
        $query = "INSERT INTO transaksi (id_barang, jumlah, total_harga, tanggal)
                  VALUES ('$id_barang', '$jumlah', '$total_harga', NOW())";

        if ($db->query($query)) {
            // Update stock barang setelah transaksi
            $stock_baru = $stock_tersedia - $jumlah;
            $update_stock_query = "UPDATE barang SET Stock = '$stock_baru' WHERE id_barang = '$id_barang'";
            $db->query($update_stock_query);

            echo "Transaksi berhasil ditambahkan!";
        } else {
            echo "Error: " . mysqli_error($connection);
        }

        // Redirect setelah transaksi ditambahkan
        header('Location: tampil_transaksi.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link rel="stylesheet" href="sidebar.css">
</head>
<body>
    <h2 class="form-title">Tambah Transaksi</h2>
    <div class="form-container">
        <form method="POST" action="tambah_transaksi.php" class="form-tambah-transaksi">
            <div class="form-group">
                <label for="id_barang">Barang:</label>
                <select name="id_barang" class="form-input" required>
                    <?php
                    // Mengambil daftar barang
                    $barang_query = "SELECT * FROM barang"; 
                    $barang_result = $db->query($barang_query);
                    while ($barang = mysqli_fetch_assoc($barang_result)) {
                        echo "<option value='" . $barang['id_barang'] . "'>" . $barang['nama_barang'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah:</label>
                <input type="number" name="jumlah" class="form-input" required>
            </div>

            <button type="submit" class="btn-submit">Tambah Transaksi</button>
        </form>
    </div>
</body>
</html>
