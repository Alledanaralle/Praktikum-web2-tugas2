# Proyek PHP OOP: Sistem Manajemen Surat Tugas dan Permohonan Izin Tugas 2

Proyek ini adalah aplikasi web berbasis PHP yang mendemonstrasikan prinsip-prinsip Pemrograman Berorientasi Objek (OOP) dalam mengelola Surat Tugas dan Permohonan Izin untuk institusi pendidikan.

## Fitur

- Manajemen koneksi database
- Operasi CRUD untuk Surat Tugas dan Permohonan Izin
- Desain Berorientasi Objek dengan pewarisan dan polimorfisme
- Frontend responsif menggunakan Bootstrap
- Izin berbasis peran (Admin dan Dosen)

## Deskripsi File

### db/database.php

File ini berisi kelas `Database` yang bertanggung jawab untuk mengelola koneksi database:

```php
<?php
class Database
{
    private $host = 'localhost';
    private $db_name = 'mydb';
    private $user = 'root';
    private $pass = '';
    public $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->pass);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo 'Connection error: ' . $exception->getMessage();
        }

        return $this->conn;
    }
}
```

Langkah-langkah:
1. Sesuaikan nilai `$host`, `$db_name`, `$user`, dan `$pass` dengan konfigurasi database.
2. Gunakan metode `getConnection()` untuk mendapatkan koneksi database di file lain.

### backend/permohonanizin.php

File ini mendefinisikan kelas-kelas yang berkaitan dengan Permohonan Izin:

```php
<?php
class PermohonanIzin
{
    protected $conn;
    public $table_name = "permohonan_izin";

    public $izin_id;
    public $nama_dsn;
    public $nip;
    public $pangkat_jabatan;
    public $jabatan;
    public $unit_kerja;
    public $dosen_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM $this->table_name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}

class PermohonanIzinDetail extends PermohonanIzin
{
    public function getIzinById()
    {
        $query = "SELECT * FROM  " . $this->table_name .  "WHERE izin_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->izin_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

abstract class User
{
    protected $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    abstract public function getPermissions();
}

class Admin extends User
{
    public function getPermissions()
    {
        return "Izin Admin";
    }
}

class Dosen extends User
{
    public function getPermissions()
    {
        return "Izin Dosen";
    }
}
```

Langkah-langkah:
1. Buat tabel `permohonan_izin` di database dengan kolom yang sesuai.
2. Implementasikan metode CRUD tambahan di kelas `PermohonanIzin`.
3. Gunakan kelas `PermohonanIzinDetail` untuk operasi khusus pada satu permohonan izin.

### backend/surattugas.php

File ini mendefinisikan kelas-kelas yang berkaitan dengan Surat Tugas:

```php
<?php
class SuratTugas
{
    protected $conn;
    public $table_name = "surat_tugas";

    public $surat_tugas_id;
    public $dosen_id;
    public $nomor;
    public $nama_dsn;
    public $tgl_surat_tugas;
    public $transportasi;
    public $keperluan;
    public $tujuan;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}

class SuratTugasDetail extends SuratTugas
{
    public function getSuratById()
    {
        $query = "SELECT * FROM  " . $this->table_name .  "WHERE surat_tugas_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->surat_tugas_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

// Kelas User, Admin, dan Dosen sama seperti di permohonanizin.php
```

Langkah-langkah:
1. Buat tabel `surat_tugas` di database dengan kolom yang sesuai.
2. Implementasikan metode CRUD tambahan di kelas `SuratTugas`.
3. Gunakan kelas `SuratTugasDetail` untuk operasi khusus pada satu surat tugas.

### frontend/permohonanizin/index.php

File ini membuat frontend untuk menampilkan daftar Permohonan Izin:

```php
<?php
include_once '../../db/database.php';
include_once '../../backend/permohonanizin.php';

$database = new Database();
$db = $database->getConnection();

$izin = new PermohonanIzin($db);
$stmt = $izin->read();

// HTML dan tabel untuk menampilkan data
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Permohonan Izin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Daftar Permohonan Izin</h2>
        <table class="table table-bordered table-striped">
            <!-- Header tabel -->
            <tbody>
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                        <td>{$row['izin_id']}</td>
                        <td>{$row['dosen_id']}</td>
                        <td>{$row['nama_dsn']}</td>
                        <td>{$row['nip']}</td>
                        <td>{$row['pangkat_jabatan']}</td>
                        <td>{$row['jabatan']}</td>
                        <td>{$row['unit_kerja']}</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
```

Langkah-langkah:
1. Pastikan path include untuk `database.php` dan `permohonanizin.php` benar.
2. Sesuaikan struktur HTML dan tabel dengan kebutuhan.
3. Tambahkan logika untuk menangani tidak ada data jika diperlukan.

### frontend/surattugas/index.php

File ini membuat frontend untuk menampilkan daftar Surat Tugas:

```php
<?php
include_once '../../db/database.php';
include_once '../../backend/surattugas.php';

$database = new Database();
$db = $database->getConnection();

$surat_tugas = new SuratTugas($db);
$stmt = $surat_tugas->read();

// HTML dan tabel untuk menampilkan data
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Surat Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Daftar Surat Tugas</h2>
        <table class="table table-bordered table-striped">
            <!-- Header tabel -->
            <tbody>
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                        <td>{$row['surat_tugas_id']}</td>
                        <td>{$row['dosen_id']}</td>
                        <td>{$row['nomor']}</td>
                        <td>{$row['nama_dsn']}</td>
                        <td>{$row['tgl_surat_tugas']}</td>
                        <td>{$row['transportasi']}</td>
                        <td>{$row['keperluan']}</td>
                        <td>{$row['tujuan']}</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
```

Langkah-langkah:
1. Pastikan path include untuk `database.php` dan `surattugas.php` benar.
2. Sesuaikan struktur HTML dan tabel dengan kebutuhan.
3. Tambahkan logika untuk menangani tidak ada data jika diperlukan.
