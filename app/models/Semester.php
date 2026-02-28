<?php

class Semester {
    private $conn;
    private $table = "semester";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT id_semester, nama_semester FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
