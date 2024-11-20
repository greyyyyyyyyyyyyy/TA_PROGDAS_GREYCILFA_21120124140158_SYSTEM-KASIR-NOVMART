<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form dan mencegah SQL Injection
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);

    // Memeriksa apakah input tidak kosong
    if (!empty($nama_barang) && !empty($harga)) {
        // Query untuk menambahkan barang ke database
        $query = "INSERT INTO barang (Nama_Barang, Harga) VALUES ('$nama_barang', '$harga')";

        // Menjalankan query dan memeriksa hasilnya
        if (mysqli_query($koneksi, $query)) {
            // Jika sukses, redirect ke halaman index.php
            header("Location: index.php");
            exit;
        } else {
            // Menampilkan error jika query gagal
            echo "Error: " . mysqli_error($koneksi);
        }
    } else {
        // Menampilkan pesan jika input kosong
        echo "Nama barang dan harga tidak boleh kosong.";
    }
}
?>

<!-- Form untuk menambah barang -->
<h2>Tambah Barang</h2>
<form method="POST" action="tambah.php">
    <label for="nama_barang">Nama Barang:</label>
    <input type="text" name="nama_barang" id="nama_barang" required><br><br>

    <label for="harga">Harga:</label>
    <input type="number" name="harga" id="harga" required><br><br>

    <button type="submit">Tambah Barang</button>
</form>
