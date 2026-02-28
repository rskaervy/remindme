<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

require_once '../config/Database.php';
$db = $GLOBALS['db'];

if (!isset($_SESSION['user_id'])) {
    die("Please login first");
}

$today = date('Y-m-d');
$tomorrow = date('Y-m-d', strtotime('+1 day'));

$sql = "
    SELECT 
        u.email,
        u.name,
        mk.nama_matakuliah,
        t.deadline
    FROM detail_tugas t
    JOIN pengampu p ON t.id_pengampu = p.id_pengampu
    JOIN mata_kuliah mk ON p.id_matakuliah = mk.id_matakuliah
    JOIN users u ON u.id_user = ?
    WHERE t.status = 'pending'
      AND (t.deadline = ? OR t.deadline = ?)
";

$stmt = $db->prepare($sql);
$stmt->execute([
    $_SESSION['user_id'],
    $today,
    $tomorrow
]);

$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($tasks)) {
    echo "No tasks to remind today.";
    exit;
}

foreach ($tasks as $task) {
    $to = $task['email'];
    $subject = "⏰ Task Reminder - RemindMe";

    $message = "
Hi {$task['name']},

This is a reminder that you have a task due soon.

Course  : {$task['nama_matakuliah']}
Deadline: {$task['deadline']}

Don't forget to complete it 😊

— RemindMe
    ";

    mail($to, $subject, $message);
}

echo "Reminder email sent successfully!";
