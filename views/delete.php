<?php
// Include database dan model
require_once '../config/database.php';
require_once '../models/Mahasiswa.php';

// Inisialisasi database
$database = new Database();
$db = $database->getConnection();

// Inisialisasi object
$mahasiswa = new Mahasiswa($db);

// Cek apakah ada ID yang dikirim
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php?message=" . urlencode("ID mahasiswa tidak valid") . "&type=danger");
    exit();
}

$mahasiswa->id = $_GET['id'];

// Ambil data mahasiswa untuk konfirmasi
if (!$mahasiswa->readOne()) {
    header("Location: index.php?message=" . urlencode("Data mahasiswa tidak ditemukan") . "&type=danger");
    exit();
}

$nama_mahasiswa = $mahasiswa->nama;

// Proses penghapusan
if ($mahasiswa->delete()) {
    header("Location: index.php?message=" . urlencode("Data mahasiswa '{$nama_mahasiswa}' berhasil dihapus") . "&type=success");
} else {
    header("Location: index.php?message=" . urlencode("Gagal menghapus data mahasiswa") . "&type=danger");
}
exit();
?>