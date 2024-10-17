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