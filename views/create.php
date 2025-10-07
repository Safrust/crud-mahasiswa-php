<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Mahasiswa - Tambah Mahasiswa</title>
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
                            <a class="nav-link text-white active" href="create.php">
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
                    <h1 class="h2"><i class="fas fa-user-plus me-2"></i>Tambah Mahasiswa</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="index.php" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>

                <?php
                if ($_POST) {
                    // Include database dan model
                    require_once '../config/database.php';
                    require_once '../models/Mahasiswa.php';

                    // Inisialisasi database
                    $database = new Database();
                    $db = $database->getConnection();

                    // Inisialisasi object
                    $mahasiswa = new Mahasiswa($db);

                    // Set property mahasiswa
                    $mahasiswa->nama = $_POST['nama'];
                    $mahasiswa->nim = $_POST['nim'];
                    $mahasiswa->tanggal_lahir = $_POST['tanggal_lahir'];
                    $mahasiswa->alamat = $_POST['alamat'];

                    // Validasi input
                    $errors = array();

                    if (empty($mahasiswa->nama)) {
                        $errors[] = "Nama harus diisi";
                    }

                    if (empty($mahasiswa->nim)) {
                        $errors[] = "NIM harus diisi";
                    } else if ($mahasiswa->nimExists()) {
                        $errors[] = "NIM sudah terdaftar";
                    }

                    if (empty($mahasiswa->tanggal_lahir)) {
                        $errors[] = "Tanggal lahir harus diisi";
                    }

                    if (empty($mahasiswa->alamat)) {
                        $errors[] = "Alamat harus diisi";
                    }

                    // Jika tidak ada error, simpan data
                    if (empty($errors)) {
                        if ($mahasiswa->create()) {
                            header("Location: index.php?message=" . urlencode("Data mahasiswa berhasil ditambahkan") . "&type=success");
                            exit();
                        } else {
                            $errors[] = "Gagal menyimpan data mahasiswa";
                        }
                    }

                    // Tampilkan error jika ada
                    if (!empty($errors)) {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
                        echo "<strong>Terjadi kesalahan:</strong><ul class='mb-0'>";
                        foreach ($errors as $error) {
                            echo "<li>{$error}</li>";
                        }
                        echo "</ul>";
                        echo "<button type='button' class='btn-close' data-bs-dismiss='alert'></button>";
                        echo "</div>";
                    }
                }
                ?>

                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-user-plus me-2"></i>Form Tambah Mahasiswa
                                </h5>
                            </div>
                            <div class="card-body">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">
                                                    <i class="fas fa-user me-1"></i>Nama Lengkap
                                                </label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       id="nama" 
                                                       name="nama" 
                                                       value="<?php echo isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?>"
                                                       placeholder="Masukkan nama lengkap"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nim" class="form-label">
                                                    <i class="fas fa-id-card me-1"></i>NIM
                                                </label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       id="nim" 
                                                       name="nim" 
                                                       value="<?php echo isset($_POST['nim']) ? htmlspecialchars($_POST['nim']) : ''; ?>"
                                                       placeholder="Masukkan NIM"
                                                       required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="tanggal_lahir" class="form-label">
                                                    <i class="fas fa-calendar me-1"></i>Tanggal Lahir
                                                </label>
                                                <input type="date" 
                                                       class="form-control" 
                                                       id="tanggal_lahir" 
                                                       name="tanggal_lahir" 
                                                       value="<?php echo isset($_POST['tanggal_lahir']) ? htmlspecialchars($_POST['tanggal_lahir']) : ''; ?>"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">
                                                    <i class="fas fa-map-marker-alt me-1"></i>Alamat
                                                </label>
                                                <textarea class="form-control" 
                                                          id="alamat" 
                                                          name="alamat" 
                                                          rows="3" 
                                                          placeholder="Masukkan alamat lengkap"
                                                          required><?php echo isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : ''; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a href="index.php" class="btn btn-secondary me-md-2">
                                            <i class="fas fa-times me-1"></i>Batal
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i>Simpan Data
                                        </button>
                                    </div>
                                </form>
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