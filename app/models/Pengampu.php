<?php

class Pengampu {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

 
    public function getCoursesBySemester($semesterId) {
        $sql = "
            SELECT 
                p.id_pengampu,
                mk.nama_matakuliah
            FROM pengampu p
            JOIN mata_kuliah mk ON p.id_matakuliah = mk.id_matakuliah
            WHERE p.id_semester = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$semesterId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getLecturerByPengampu($pengampuId) {
        $sql = "
            SELECT 
                d.nama_dosen
            FROM pengampu p
            JOIN dosen d ON p.id_dosen = d.id_dosen
            WHERE p.id_pengampu = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$pengampuId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
