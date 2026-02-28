<?php
require_once '../../app/config/Database.php';

$database = new Database();
$db = $database->connect();

$semesterId = $_GET['semester_id'] ?? null;

if (!$semesterId) {
    echo json_encode([]);
    exit;
}

$sql = "
    SELECT 
        p.id_pengampu,
        mk.nama_matakuliah
    FROM pengampu p
    JOIN mata_kuliah mk ON p.id_matakuliah = mk.id_matakuliah
    WHERE p.id_semester = ?
";

$stmt = $db->prepare($sql);
$stmt->execute([$semesterId]);

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
