<?php
include 'koneksi.php';

// Membuat objek dari kelas Database
$db = new Database();
$connection = $db->getConnection(); // Mendapatkan objek koneksi

// Mengecek apakah parameter 'id_transaksi' ada dalam URL
if (isset($_GET['id_transaksi'])) {
    $id_transaksi = $_GET['id_transaksi'];
    
    // Query untuk mengambil data transaksi berdasarkan id_transaksi
    $query = "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'";
    $result = $db->query($query);

    // Menangani hasil query
    if ($result) {
        $data = $result->fetch_assoc();  // Menyimpan data transaksi
    } else {
        die("Query gagal: " . $connection->error);  // Menangani error query
    }
}

// Mengecek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_transaksi = $_POST['id_transaksi'];
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $total_harga = $_POST['total_harga'];

    // Query untuk memperbarui transaksi
    $update_query = "UPDATE transaksi SET id_barang = '$id_barang', jumlah = '$jumlah', total_harga = '$total_harga' WHERE id_transaksi = '$id_transaksi'";

    // Menjalankan query untuk update transaksi
    if ($db->query($update_query)) {
        echo "Transaksi berhasil diperbarui!";
        header('Location: tampil_transaksi.php');
        exit;
    } else {
        echo "Error: " . $connection->error;
    }
}
?>

<!-- Form untuk mengedit transaksi -->
<form action="edit_transaksi.php" method="POST">
    <input type="hidden" name="id_transaksi" value="<?php echo $data['id_transaksi']; ?>">
    
    <label for="id_barang">Barang:</label>
    <select name="id_barang" id="id_barang">
        <?php
        // Query untuk mengambil daftar barang
        $barang_query = "SELECT * FROM barang";
        $barang_result = $db->query($barang_query);

        // Menampilkan barang dalam dropdown
        while ($barang = $barang_result->fetch_assoc()) {
            echo "<option value='" . $barang['id_barang'] . "' " . ($data['id_barang'] == $barang['id_barang'] ? 'selected' : '') . ">" . $barang['nama_barang'] . "</option>";
        }
        ?>
    </select><br>
    
    <label for="jumlah">Jumlah:</label>
    <input type="number" name="jumlah" value="<?php echo $data['jumlah']; ?>" required><br>
    
    <label for="total_harga">Total Harga:</label>
    <input type="number" name="total_harga" value="<?php echo $data['total_harga']; ?>" required><br>
    
    <button type="submit">Perbarui Transaksi</button>
</form>
