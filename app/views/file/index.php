<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>File Tugas Selesai</title>

<style>
body {
    background: #f4f6fb;
    font-family: Arial, sans-serif;
}

.container {
    max-width: 1000px;
    margin: 40px auto;
    background: white;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.header h2 {
    margin: 0;
    color: #3F5BD8;
}

.back {
    text-decoration: none;
    color: #3F5BD8;
    font-weight: bold;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 14px;
    border-bottom: 1px solid #eee;
    text-align: left;
}

th {
    background: #f4f6fb;
    font-size: 14px;
}

.file-name {
    font-weight: bold;
}

.download {
    background: #3F5BD8;
    color: white;
    padding: 8px 14px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 13px;
}

.download:hover {
    opacity: 0.9;
}

.empty {
    text-align: center;
    padding: 60px 20px;
    color: #777;
}

.empty a {
    display: inline-block;
    margin-top: 16px;
    text-decoration: none;
    background: #3F5BD8;
    color: white;
    padding: 10px 18px;
    border-radius: 12px;
}
</style>
</head>
<body>

<div class="container">

    <div class="header">
        <h2>📁 File Task Done</h2>
        <a href="index.php?c=dashboard&a=index" class="back">← Back</a>
    </div>

    <?php if (empty($files)): ?>
        <div class="empty">
            <p>No completed task files available.</p>
            <a href="index.php?c=task&a=create">➕ Add Task</a>
        </div>
    <?php else: ?>

    <table>
        <tr>
            <th>Course</th>
            <th>Lecturer</th>
            <th>Deadline</th>
            <th>File</th>
            <th>Download</th>
        </tr>

        <?php foreach ($files as $f): ?>
        <tr>
            <td><?= htmlspecialchars($f['nama_matakuliah']) ?></td>
            <td><?= htmlspecialchars($f['nama_dosen']) ?></td>
            <td><?= htmlspecialchars($f['deadline']) ?></td>
            <td class="file-name"><?= htmlspecialchars($f['result_file']) ?></td>
            <td><a class="download"href="/remindme/public/uploads/<?= rawurlencode($f['result_file']) ?>"download title="Download file">⬇</a></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php endif; ?>

</div>

</body>
</html>
