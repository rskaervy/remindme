<?php
class File {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllFiles() {
        $stmt = $this->db->prepare("SELECT * FROM files ORDER BY uploaded_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
