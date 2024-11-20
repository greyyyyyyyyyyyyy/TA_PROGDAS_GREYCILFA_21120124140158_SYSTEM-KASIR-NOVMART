<?php
class Database {
    private $host = 'localhost';      // Host database
    private $username = 'root';       // Username database
    private $password = '';           // Password database
    private $dbname = 'kasir_db';     // Nama database yang baru
    public $connection;

    // Konstruktor untuk membuat koneksi
    public function __construct() {
        // Membuat koneksi
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        
        // Mengecek apakah koneksi berhasil
        if ($this->connection->connect_error) {
            die("Koneksi gagal: " . $this->connection->connect_error);
        }
    }

    // Metode untuk mendapatkan koneksi
    public function getConnection() {
        return $this->connection;
    }

    // Metode untuk menjalankan query
    public function query($query) {
        return $this->connection->query($query);
    }
}
?>
