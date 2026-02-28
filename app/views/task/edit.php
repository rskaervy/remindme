<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Task | RemindMe</title>

<style>
* {
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    margin: 0;
    background: #f4f6fb;
}


.task-container {
    max-width: 1000px;
    margin: 40px auto;
    background: white;
    padding: 40px 50px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* HEADER */
.task-header {
    margin-bottom: 30px;
}

.task-header h2 {
    margin: 0;
    color: #3F5BD8;
}

.task-header p {
    color: #777;
    font-size: 14px;
}

/* FORM */
.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    font-size: 14px;
    margin-bottom: 6px;
    color: #555;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #ddd;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border: 1.5px solid #3F5BD8;
    outline: none;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

textarea {
    resize: none;
    height: 90px;
}

.actions {
    display: flex;
    justify-content: flex-end;
    gap: 14px;
    margin-top: 30px;
}

.btn {
    padding: 12px 22px;
    border-radius: 14px;
    text-decoration: none;
    font-weight: bold;
    min-width: 120px;
    text-align: center;
    transition: 0.3s ease;
}

.save {
    background: #3F5BD8;
    color: white;
    border: none;
    cursor: pointer;
}

.cancel {
    background: #eaeefe;
    color: #3F5BD8;
}

.btn:hover {
    transform: translateY(-2px);
}

.alert-warning {
    background: #fff3cd;
    color: #856404;
    padding: 14px 18px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 14px;
}

@media (max-width: 768px) {

    .form-row {
        grid-template-columns: 1fr;
    }

    .task-container {
        padding: 25px 20px;
        margin: 20px;
    }
}
</style>
</head>
<body>

<div class="task-container">

    <div class="task-header">
        <h2>Edit Task</h2>
        <p>Update your task information</p>
    </div>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'upload_required'): ?>
        <div class="alert-warning">
            Please upload task result before marking as done.
        </div>
    <?php endif; ?>


    <form method="POST"
      action="index.php?c=task&a=update&id=<?= $task['id_tugas'] ?>"
      enctype="multipart/form-data">

   
    <div class="form-group">
        <label>Course</label>
        <input type="text" value="<?= htmlspecialchars($task['nama_matakuliah']) ?>" readonly>
    </div>

 
    <div class="form-group">
        <label>Lecturer</label>
        <input type="text" value="<?= htmlspecialchars($task['nama_dosen']) ?>" readonly>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Deadline Date</label>
            <input type="date" name="deadline" value="<?= $task['deadline'] ?>" min="<?= date('Y-m-d') ?>" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="pending" <?= $task['status']=='pending'?'selected':'' ?>>
                    Pending
                </option>
                <option value="done" <?= $task['status']=='done'?'selected':'' ?>>
                    Done
                </option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description"><?= htmlspecialchars($task['deskripsi']) ?></textarea>
    </div>

    <div class="form-group" id="uploadResult" style="display:none;">
        <label>Upload Task Result</label>
        <input type="file" name="result_file" accept=".pdf,.doc,.docx,.zip">
        <small style="color:#777;">
            Upload task result to mark this task as done
        </small>
    </div>

    <div class="actions">
        <button type="submit" class="btn save">Update Task</button>
        <a href="index.php?c=dashboard&a=index" class="btn cancel">Cancel</a>
    </div>

</form>


</div>
<script>
const statusSelect = document.querySelector('select[name="status"]');
const uploadBox = document.getElementById('uploadResult');

function toggleUpload() {
    if (statusSelect.value === 'done') {
        uploadBox.style.display = 'block';
    } else {
        uploadBox.style.display = 'none';
    }
}

toggleUpload();

statusSelect.addEventListener('change', toggleUpload);
</script>

</body>
</html>
