# 🎓 CRUD Mahasiswa - Sistem Informasi Mahasiswa

[![PHP](https://img.shields.io/badge/PHP-8.2.4-blue.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-orange.svg)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.1.3-purple.svg)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

# 🎓 CRUD Mahasiswa - Sistem Informasi Mahasiswa

[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange.svg)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.1.3-purple.svg)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

Aplikasi web CRUD (Create, Read, Update, Delete) modern untuk mengelola data mahasiswa dengan antarmuka yang responsif dan fitur keamanan yang kuat. Dibangun menggunakan PHP, MySQL, dan Bootstrap 5.

## 🚀 Demo Live

🌐 **[View Live Demo](https://your-username.github.io/crud-mahasiswa)** *(Coming Soon)*

## 📸 Screenshots

### Dashboard Utama
![Dashboard](docs/screenshots/dashboard.png)

### Form Tambah Mahasiswa  
![Create Form](docs/screenshots/create-form.png)

### Mobile Responsive
![Mobile View](docs/screenshots/mobile-view.png)

## ✨ Fitur Utama

- 📊 **Dashboard** - Tampilan data mahasiswa dengan sidebar navigation
- ➕ **Tambah Mahasiswa** - Form input data mahasiswa baru dengan validasi
- 👁️ **Lihat Detail** - Detail lengkap informasi mahasiswa
- ✏️ **Edit Data** - Update informasi mahasiswa existing
- 🗑️ **Hapus Data** - Delete data dengan konfirmasi safety
- 🔍 **Validasi Input** - Comprehensive input validation dan sanitization
- 🛡️ **Keamanan** - SQL injection protection dan XSS prevention
- 📱 **Responsive Design** - Mobile-friendly interface dengan Bootstrap 5

## 🔧 Teknologi Stack

- **Backend**: PHP 8.2.4 dengan PDO
- **Database**: MySQL 8.0
- **Frontend**: Bootstrap 5.1.3 + Font Awesome 6.0
- **Server**: Apache 2.4.56 (XAMPP)
- **Architecture**: MVC Pattern

## 🛠️ Instalasi & Setup

### Persyaratan Sistem
- XAMPP (Apache + MySQL + PHP 8.2+)
- Web Browser modern (Chrome, Firefox, Edge)
- Git (untuk clone repository)

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/your-username/crud-mahasiswa.git
   cd crud-mahasiswa
   ```

2. **Copy ke XAMPP Directory**
   ```bash
   # Windows
   copy -r * D:\xampp\htdocs\crud_mahasiswa\
   
   # Linux/Mac
   cp -r * /opt/lampp/htdocs/crud_mahasiswa/
   ```

3. **Start XAMPP Services**
   - Buka XAMPP Control Panel
   - Start Apache dan MySQL

4. **Setup Database**
   - Buka phpMyAdmin: `http://localhost/phpmyadmin`
   - Create database: `crud_mahasiswa`
   - Import file: `database/crud_mahasiswa.sql`

5. **Konfigurasi Database** (Opsional)
   - Edit `config/database.php` jika perlu adjust setting
   - Default: localhost, root, no password

6. **Akses Aplikasi**
   ```
   http://localhost/crud_mahasiswa
   ```

## 📁 Struktur Project

## 📋 Fitur Aplikasi

- ✅ **Create**: Menambah data mahasiswa baru
- ✅ **Read**: Menampilkan daftar dan detail mahasiswa
- ✅ **Update**: Mengedit data mahasiswa yang sudah ada
- ✅ **Delete**: Menghapus data mahasiswa
- 🔍 **Validasi**: Validasi input data dan NIM unik
- 📱 **Responsive**: Tampilan yang responsif untuk berbagai ukuran layar
- 🎨 **UI Modern**: Menggunakan Bootstrap 5 dan Font Awesome

## 📁 Struktur Project

```
crud_mahasiswa/
├── assets/
│   └── css/
│       └── style.css          # Custom CSS
├── config/
│   └── database.php           # Konfigurasi database
├── database/
│   └── crud_mahasiswa.sql     # File SQL database
├── models/
│   └── Mahasiswa.php          # Model class Mahasiswa
├── views/
│   ├── index.php              # Halaman utama (daftar mahasiswa)
│   ├── create.php             # Form tambah mahasiswa
│   ├── edit.php               # Form edit mahasiswa
│   ├── view.php               # Detail mahasiswa
│   └── delete.php             # Proses hapus mahasiswa
└── README.md                  # File dokumentasi ini
```

## 🛠️ Teknologi yang Digunakan

- **Frontend**: HTML5, CSS3, Bootstrap 5, Font Awesome
- **Backend**: PHP 7.4+
- **Database**: MySQL/MariaDB
- **Server**: Apache (XAMPP/WAMP/LAMP)

## ⚙️ Instalasi dan Setup

### 1. Persiapan Environment

Pastikan Anda telah menginstall:

- XAMPP/WAMP/LAMP (Apache + MySQL + PHP)
- Web browser (Chrome, Firefox, dll)

### 2. Setup Database

1. Buka phpMyAdmin atau MySQL command line
2. Buat database baru dengan nama `crud_mahasiswa`
3. Import file `database/crud_mahasiswa.sql` ke dalam database tersebut

```sql
CREATE DATABASE crud_mahasiswa;
```

### 3. Konfigurasi Database

Edit file `config/database.php` sesuai dengan konfigurasi database Anda:

```php
private $host = "localhost";        // Host database
private $db_name = "crud_mahasiswa"; // Nama database
private $username = "root";          // Username database
private $password = "";              // Password database
```

### 4. Menjalankan Aplikasi

1. Copy folder project ke direktori web server (htdocs/www)
2. Jalankan Apache dan MySQL melalui XAMPP/WAMP
3. Buka browser dan akses: `http://localhost/crud_mahasiswa/views/`

## 📊 Struktur Database

Tabel `mahasiswa`:

- `id` (PRIMARY KEY, AUTO_INCREMENT)
- `nama` (VARCHAR 100, NOT NULL)
- `nim` (VARCHAR 20, NOT NULL, UNIQUE)
- `tanggal_lahir` (DATE, NOT NULL)
- `alamat` (TEXT, NOT NULL)
- `created_at` (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)
- `updated_at` (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE)

## 🖥️ Tampilan Aplikasi

### Halaman Utama (Dashboard)

- Menampilkan daftar semua mahasiswa dalam bentuk tabel
- Tombol aksi untuk lihat detail, edit, dan hapus
- Counter jumlah data mahasiswa
- Sidebar navigasi

### Form Tambah Mahasiswa

- Form input untuk nama, NIM, tanggal lahir, dan alamat
- Validasi input dan pengecekan NIM duplikat
- Pesan error dan sukses

### Form Edit Mahasiswa

- Form yang terisi dengan data mahasiswa yang akan diedit
- Validasi yang sama dengan form tambah
- Pengecekan NIM duplikat (kecuali untuk data sendiri)

### Detail Mahasiswa

- Menampilkan informasi lengkap mahasiswa
- Menghitung umur berdasarkan tanggal lahir
- Tombol edit dan hapus

## 🔧 Fitur Teknis

### Keamanan

- Input sanitization menggunakan `htmlspecialchars()` dan `strip_tags()`
- Prepared statements untuk mencegah SQL injection
- Validasi data di sisi server

### Database

- Menggunakan PDO (PHP Data Objects) untuk koneksi database
- Transaction handling untuk operasi database
- Error handling yang proper

### UI/UX

- Responsive design menggunakan Bootstrap 5
- Icon dari Font Awesome
- Loading states dan feedback messages
- Konfirmasi sebelum menghapus data

## 📝 Cara Penggunaan

### Menambah Data Mahasiswa

1. Klik tombol "Tambah Mahasiswa" di dashboard
2. Isi form dengan data yang valid
3. Klik "Simpan Data"

### Melihat Detail Mahasiswa

1. Di tabel daftar mahasiswa, klik tombol mata (👁️) pada baris data
2. Akan menampilkan detail lengkap mahasiswa

### Mengedit Data Mahasiswa

1. Di tabel daftar mahasiswa, klik tombol edit (✏️) pada baris data
2. Ubah data yang diperlukan
3. Klik "Update Data"

### Menghapus Data Mahasiswa

1. Di tabel daftar mahasiswa, klik tombol hapus (🗑️) pada baris data
2. Konfirmasi penghapusan data
3. Data akan dihapus dari database

## 🚀 Pengembangan Lebih Lanjut

Fitur yang bisa ditambahkan:

- [ ] Sistem login dan autentikasi
- [ ] Pencarian dan filter data
- [ ] Pagination untuk data yang banyak
- [ ] Export data ke Excel/PDF
- [ ] Upload foto mahasiswa
- [ ] Riwayat perubahan data (audit trail)
- [ ] API REST untuk integrasi mobile

## 🐛 Troubleshooting

### Error Koneksi Database

- Pastikan MySQL service berjalan
- Cek konfigurasi database di `config/database.php`
- Pastikan database `crud_mahasiswa` sudah dibuat

### Error 404 Not Found

- Pastikan Apache service berjalan
- Cek path direktori project di web server
- Pastikan mengakses melalui `views/` directory

### Error Permission Denied

- Pastikan direktori memiliki permission yang tepat
- Pada Linux/Mac: `chmod 755 crud_mahasiswa/`

## 📞 Support

Jika mengalami masalah atau memiliki pertanyaan, silakan:

1. Cek bagian troubleshooting di atas
2. Review kembali langkah instalasi
3. Pastikan semua requirement sudah terpenuhi

## 📄 Lisensi

Project ini dibuat untuk keperluan pembelajaran dan tugas kuliah.

---

**Dibuat oleh**: [Nama Anda]  
**Mata Kuliah**: Pemrograman Platform Web A  
**Tanggal**: Oktober 2025
