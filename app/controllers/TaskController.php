<?php

class TaskController {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?c=auth&a=login");
            exit;
        }

        require_once '../app/models/Semester.php';

        $semesterModel = new Semester($this->db);
        $semesters = $semesterModel->getAll();

        include '../app/views/task/create.php';
    }

    public function getCourses() {
        require_once '../app/models/Pengampu.php';

        $pengampu = new Pengampu($this->db);

        $semesterId = $_GET['semester_id'];
        $courses = $pengampu->getCoursesBySemester($semesterId);

        header('Content-Type: application/json');
        echo json_encode($courses);
    }

    public function getLecturer() {
        require_once '../app/models/Pengampu.php';

        $pengampu = new Pengampu($this->db);

        $pengampuId = $_GET['pengampu_id'];
        $lecturer = $pengampu->getLecturerByPengampu($pengampuId);

        header('Content-Type: application/json');
        echo json_encode($lecturer);
    }

    public function store() {
        $resultFile = null;

    if (!empty($_FILES['result_file']['name'])) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
    }

        $resultFile = time() . '_' . $_FILES['result_file']['name'];
        move_uploaded_file($_FILES['result_file']['tmp_name'], $uploadDir . $resultFile);
    }

        $sql = "
            INSERT INTO detail_tugas
            (id_pengampu, status, deadline, deskripsi,result_file)
            VALUES (?, ?, ?, ?, ?)
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $_POST['id_pengampu'],
            $_POST['status'],
            $_POST['deadline'],
            $_POST['description'],
            $resultFile
        ]);

        header("Location: index.php?c=dashboard&a=index");
        exit;
    }

    public function edit() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?c=auth&a=login");
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?c=dashboard&a=index");
            exit;
        }

        $sql = "
            SELECT 
                t.id_tugas,
                t.deadline,
                t.status,
                t.deskripsi,
                mk.nama_matakuliah,
                d.nama_dosen
            FROM detail_tugas t
            LEFT JOIN pengampu p ON t.id_pengampu = p.id_pengampu
            LEFT JOIN mata_kuliah mk ON p.id_matakuliah = mk.id_matakuliah
            LEFT JOIN dosen d ON p.id_dosen = d.id_dosen
            WHERE t.id_tugas = ?
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $task = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$task) {
            echo "TASK NOT FOUND";
            exit;
        }

        include '../app/views/task/edit.php';
    }

    public function update() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?c=auth&a=login");
            exit;
        }

        require_once '../app/config/Database.php'; 
        $db = $GLOBALS['db'];

        $id = $_GET['id'];

        if ($_POST['status'] === 'done' && empty($_FILES['result_file']['name'])) {
           header("Location: index.php?c=task&a=edit&id=$id&error=upload_required");
            exit;

        }

        $resultFile = null;
        if (!empty($_FILES['result_file']['name'])) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $resultFile = time().'_'.$_FILES['result_file']['name'];
            move_uploaded_file($_FILES['result_file']['tmp_name'], $uploadDir.$resultFile);
        }

        if ($resultFile) {
            $sql = "UPDATE detail_tugas
                    SET status=?, deadline=?, deskripsi=?, result_file=?
                    WHERE id_tugas=?";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                $_POST['status'],
                $_POST['deadline'],
                $_POST['description'],
                $resultFile,
                $id
            ]);
        } else {
            $sql = "UPDATE detail_tugas
                    SET status=?, deadline=?, deskripsi=?
                    WHERE id_tugas=?";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                $_POST['status'],
                $_POST['deadline'],
                $_POST['description'],
                $id
            ]);
        }

        header("Location: index.php?c=dashboard&a=index");
        exit;
    }

    public function delete() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?c=auth&a=login");
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?c=dashboard&a=index");
            exit;
        }

        $stmt = $this->db->prepare("DELETE FROM detail_tugas WHERE id_tugas = ?");
        $stmt->execute([$id]);

        header("Location: index.php?c=dashboard&a=index");
        exit;
    }
}
