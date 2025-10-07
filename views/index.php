<?php
// Production setting - disable error display
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem CRUD Mahasiswa - Aplikasi manajemen data mahasiswa dengan PHP dan MySQL">
    <meta name="keywords" content="CRUD, Mahasiswa, PHP, MySQL, Bootstrap, Sistem Informasi">
    <meta name="author" content="Student Project">
    <title>CRUD Mahasiswa - Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 0;
            box-shadow: 2px 0 6px rgba(0,0,0,.1);
        }
        .sidebar .nav-link {
            border-radius: 0.375rem;
            margin: 0.25rem 0.5rem;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
        }
        .sidebar .nav-link.active {
            background-color: rgba(255,255,255,0.2);
        }
        .avatar-sm {
            width: 32px;
            height: 32px;
            font-size: 12px;
        }
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-primary sidebar">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h5 class="text-white">CRUD Mahasiswa</h5>
                        <small class="text-light">Sistem Informasi Mahasiswa</small>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white active" href="index.php">
                                <i class="fas fa-users me-2"></i>Data Mahasiswa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="create.php">
                                <i class="fas fa-user-plus me-2"></i>Tambah Mahasiswa
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><i class="fas fa-users me-2"></i>Data Mahasiswa</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="create.php" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Tambah Mahasiswa
                        </a>
                    </div>
                </div>
                <?php
                // Show success/error messages
                if(isset($_GET['message'])) {
                    $message = $_GET['message'];
                    $type = isset($_GET['type']) ? $_GET['type'] : 'success';
                    echo "<div class='alert alert-{$type} alert-dismissible fade show' role='alert'>
                            {$message}
                            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                          </div>";
                }
                ?>
        
        <?php
        try {
            // Include files dengan error handling
            if (!file_exists('../config/database.php')) {
                throw new Exception("File config/database.php tidak ditemukan");
            }
            require_once '../config/database.php';
            
            if (!file_exists('../models/Mahasiswa.php')) {
                throw new Exception("File models/Mahasiswa.php tidak ditemukan");
            }
            require_once '../models/Mahasiswa.php';

            // Database connection
            $database = new Database();
            $db = $database->getConnection();
            
            if (!$db) {
                throw new Exception("Koneksi database gagal");
            }

            echo "<div class='alert alert-success'><i class='fas fa-check'></i> Koneksi database berhasil!</div>";

            // Create mahasiswa object
            $mahasiswa = new Mahasiswa($db);
            $stmt = $mahasiswa->read();
            $num = $stmt->rowCount();

            echo "<div class='card'>";
            echo "<div class='card-header bg-light'>";
            echo "<h5 class='card-title mb-0'><i class='fas fa-list me-2'></i>Daftar Mahasiswa <span class='badge bg-primary ms-2'>{$num} data</span></h5>";
            echo "</div>";
            echo "<div class='card-body'>";

            if ($num > 0) {
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped'>";
                echo "<thead class='table-dark'>";
                echo "<tr><th>No</th><th>Nama</th><th>NIM</th><th>Tanggal Lahir</th><th>Alamat</th><th>Aksi</th></tr>";
                echo "</thead><tbody>";
                
                $no = 1;
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $tanggal_formatted = date('d/m/Y', strtotime($tanggal_lahir));
                    echo "<tr>";
                    echo "<td>{$no}</td>";
                    echo "<td>";
                    echo "<div class='d-flex align-items-center'>";
                    echo "<div class='avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-2'>";
                    echo "<i class='fas fa-user text-white'></i>";
                    echo "</div>";
                    echo "<strong>" . htmlspecialchars($nama) . "</strong>";
                    echo "</div>";
                    echo "</td>";
                    echo "<td><span class='badge bg-secondary'>" . htmlspecialchars($nim) . "</span></td>";
                    echo "<td>{$tanggal_formatted}</td>";
                    echo "<td>" . htmlspecialchars($alamat) . "</td>";
                    echo "<td>";
                    echo "<div class='btn-group' role='group'>";
                    echo "<a href='view.php?id={$id}' class='btn btn-info btn-sm' title='Lihat Detail'><i class='fas fa-eye'></i></a>";
                    echo "<a href='edit.php?id={$id}' class='btn btn-warning btn-sm' title='Edit'><i class='fas fa-edit'></i></a>";
                    echo "<a href='delete.php?id={$id}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin hapus data {$nama}?\")' title='Hapus'><i class='fas fa-trash'></i></a>";
                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                    $no++;
                }
                echo "</tbody></table></div>";
            } else {
                echo "<div class='text-center py-4'>";
                echo "<i class='fas fa-users fa-3x text-muted mb-3'></i>";
                echo "<h5>Belum ada data mahasiswa</h5>";
                echo "<p class='text-muted'>Klik tombol \"Tambah Mahasiswa\" untuk menambahkan data baru.</p>";
                echo "<a href='create.php' class='btn btn-primary'><i class='fas fa-plus me-1'></i>Tambah Mahasiswa Pertama</a>";
                echo "</div>";
            }
            echo "</div></div>";

        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>";
            echo "<h5><i class='fas fa-exclamation-triangle'></i> Error Database</h5>";
            echo "<p><strong>Pesan:</strong> " . $e->getMessage() . "</p>";
            echo "<h6>Solusi:</h6>";
            echo "<ol>";
            echo "<li>Pastikan XAMPP MySQL berjalan</li>";
            echo "<li>Buat database 'crud_mahasiswa' di phpMyAdmin</li>";
            echo "<li>Import file: database/crud_mahasiswa.sql</li>";
            echo "</ol>";
            echo "</div>";
        }
        ?>
        
        </main>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add fade-in animation to main content
        document.querySelector('main').classList.add('fade-in');
        
        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert-dismissible');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>
</html>