<?php

class FileController {

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?c=auth&a=login");
            exit;
        }

        require_once '../app/config/Database.php';
        $db = $GLOBALS['db'];

        $sql = "
            SELECT 
                t.id_tugas,
                mk.nama_matakuliah,
                d.nama_dosen,
                t.deadline,
                t.result_file
            FROM detail_tugas t
            JOIN pengampu p ON t.id_pengampu = p.id_pengampu
            JOIN mata_kuliah mk ON p.id_matakuliah = mk.id_matakuliah
            JOIN dosen d ON p.id_dosen = d.id_dosen
            WHERE t.status = 'done'
              AND t.result_file IS NOT NULL
            ORDER BY t.deadline DESC
        ";

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $files = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include '../app/views/file/index.php';
    }
}
