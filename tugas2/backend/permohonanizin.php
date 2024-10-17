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
        $stmt->bindParam(1, parent::$izin_id);
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
        return "Admin Permissions";
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
