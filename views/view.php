<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Mahasiswa - Detail Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
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
                            <a class="nav-link text-white" href="index.php">
                                <i class="fas fa-users me-2"></i>
                                Data Mahasiswa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="create.php">
                                <i class="fas fa-user-plus me-2"></i>
                                Tambah Mahasiswa
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><i class="fas fa-eye me-2"></i>Detail Mahasiswa</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="index.php" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>

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

                // Ambil data mahasiswa
                if (!$mahasiswa->readOne()) {
                    header("Location: index.php?message=" . urlencode("Data mahasiswa tidak ditemukan") . "&type=danger");
                    exit();
                }

                // Format tanggal
                $tanggal_formatted = date('d F Y', strtotime($mahasiswa->tanggal_lahir));
                $umur = date_diff(date_create($mahasiswa->tanggal_lahir), date_create('today'))->y;
                ?>

                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-user me-2"></i>Informasi Detail Mahasiswa
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <div class="avatar-lg bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                            <i class="fas fa-user fa-3x text-white"></i>
                                        </div>
                                        <h5 class="card-title"><?php echo htmlspecialchars($mahasiswa->nama); ?></h5>
                                        <p class="text-muted">Mahasiswa</p>
                                    </div>
                                    <div class="col-md-8">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td width="30%"><strong><i class="fas fa-id-card me-2 text-primary"></i>NIM</strong></td>
                                                <td>: <span class="badge bg-secondary fs-6"><?php echo htmlspecialchars($mahasiswa->nim); ?></span></td>
                                            </tr>
                                            <tr>
                                                <td><strong><i class="fas fa-user me-2 text-primary"></i>Nama Lengkap</strong></td>
                                                <td>: <?php echo htmlspecialchars($mahasiswa->nama); ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong><i class="fas fa-calendar me-2 text-primary"></i>Tanggal Lahir</strong></td>
                                                <td>: <?php echo $tanggal_formatted; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong><i class="fas fa-birthday-cake me-2 text-primary"></i>Umur</strong></td>
                                                <td>: <?php echo $umur; ?> tahun</td>
                                            </tr>
                                            <tr>
                                                <td><strong><i class="fas fa-map-marker-alt me-2 text-primary"></i>Alamat</strong></td>
                                                <td>: <?php echo nl2br(htmlspecialchars($mahasiswa->alamat)); ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="edit.php?id=<?php echo $mahasiswa->id; ?>" class="btn btn-warning">
                                            <i class="fas fa-edit me-1"></i>Edit Data
                                        </a>
                                        <a href="delete.php?id=<?php echo $mahasiswa->id; ?>" 
                                           class="btn btn-danger"
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa <?php echo htmlspecialchars($mahasiswa->nama); ?>?')">
                                            <i class="fas fa-trash me-1"></i>Hapus Data
                                        </a>
                                    </div>
                                    <div>
                                        <a href="index.php" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left me-1"></i>Kembali ke Daftar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>