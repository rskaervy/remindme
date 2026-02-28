<?php

class DashboardController {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

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
                t.status,
                t.deadline
            FROM detail_tugas t
            LEFT JOIN pengampu p ON t.id_pengampu = p.id_pengampu
            LEFT JOIN mata_kuliah mk ON p.id_matakuliah = mk.id_matakuliah
            LEFT JOIN dosen d ON p.id_dosen = d.id_dosen
            ORDER BY t.id_tugas DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

      
        $totalTasks = count($tasks);
        $completedTasks = 0;
        $pendingTasks = 0;

        foreach ($tasks as $task) {
            if ($task['status'] === 'done') {
                $completedTasks++;
            } else {
                $pendingTasks++;
            }
        }

       $today = date('Y-m-d');

        $notifStmt = $db->prepare("
            SELECT COUNT(*) as total
            FROM detail_tugas
            WHERE status = 'pending'
            AND deadline <= DATE_ADD(?, INTERVAL 1 DAY)
        ");

        $notifStmt->execute([$today]); 
        $notif = $notifStmt->fetch(PDO::FETCH_ASSOC);



        include '../app/views/dashboard/index.php';
    }
}
