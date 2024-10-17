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
        $stmt->bindParam(1, parent::$surat_tugas_id);
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
        return "Admin Permissions" . "<br>";
    }
}

class Dosen extends User
{
    public function getPermissions()
    {
        return "Dosen Permissions";
    }
}

// Penggunaan polymorphism
$admin = new Admin('Admin');
$dosen = new Dosen('Dosen');
