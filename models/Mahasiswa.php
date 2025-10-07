<?php
require_once '../config/database.php';

class Mahasiswa {
    private $conn;
    private $table_name = "mahasiswa";

    public $id;
    public $nama;
    public $nim;
    public $tanggal_lahir;
    public $alamat;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create - Menambah data mahasiswa
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET nama=:nama, nim=:nim, tanggal_lahir=:tanggal_lahir, alamat=:alamat";
        
        $stmt = $this->conn->prepare($query);
        
        // Sanitize input
        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->nim = htmlspecialchars(strip_tags($this->nim));
        $this->tanggal_lahir = htmlspecialchars(strip_tags($this->tanggal_lahir));
        $this->alamat = htmlspecialchars(strip_tags($this->alamat));
        
        // Bind values
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":nim", $this->nim);
        $stmt->bindParam(":tanggal_lahir", $this->tanggal_lahir);
        $stmt->bindParam(":alamat", $this->alamat);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Read - Membaca semua data mahasiswa
    public function read() {
        $query = "SELECT id, nama, nim, tanggal_lahir, alamat FROM " . $this->table_name . " ORDER BY nama ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read single - Membaca data mahasiswa berdasarkan ID
    public function readOne() {
        $query = "SELECT id, nama, nim, tanggal_lahir, alamat FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->nama = $row['nama'];
            $this->nim = $row['nim'];
            $this->tanggal_lahir = $row['tanggal_lahir'];
            $this->alamat = $row['alamat'];
            return true;
        }
        return false;
    }

    // Update - Mengupdate data mahasiswa
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET nama = :nama, nim = :nim, tanggal_lahir = :tanggal_lahir, alamat = :alamat 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        // Sanitize input
        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->nim = htmlspecialchars(strip_tags($this->nim));
        $this->tanggal_lahir = htmlspecialchars(strip_tags($this->tanggal_lahir));
        $this->alamat = htmlspecialchars(strip_tags($this->alamat));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        // Bind values
        $stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':nim', $this->nim);
        $stmt->bindParam(':tanggal_lahir', $this->tanggal_lahir);
        $stmt->bindParam(':alamat', $this->alamat);
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete - Menghapus data mahasiswa
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Cek apakah NIM sudah ada
    public function nimExists() {
        $query = "SELECT id FROM " . $this->table_name . " WHERE nim = :nim";
        if(isset($this->id)) {
            $query .= " AND id != :id";
        }
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nim', $this->nim);
        if(isset($this->id)) {
            $stmt->bindParam(':id', $this->id);
        }
        
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
?>