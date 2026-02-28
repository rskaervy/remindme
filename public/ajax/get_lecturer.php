<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../../app/config/Database.php';

$pengampuId = $_GET['pengampu_id'] ?? null;

if (!$pengampuId) {
    echo json_encode(["error" => "pengampu_id kosong"]);
    exit;
}

$sql = "
    SELECT d.nama_dosen
    FROM pengampu p
    JOIN dosen d ON p.id_dosen = d.id_dosen
    WHERE p.id_pengampu = ?
";

$stmt = $db->prepare($sql);
$stmt->execute([$pengampuId]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode([
    "nama_dosen" => $data['nama_dosen'] ?? '-'
]);
