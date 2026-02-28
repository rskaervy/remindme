<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Task | RemindMe</title>

<style>
* {
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    margin: 0;
    background: #f4f6fb;
}

/* CARD */
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
    text-align: left;
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

/* BUTTON */
.actions {
    display: flex;
    justify-content: center;
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

.bottom-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 30px;
}

.lecturer-box {
    margin: 0;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #ddd;
    background: #f4f6fb;
    color: #333;
    min-height: 44px;
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
        <h2>Add New Task</h2>
        <p>Create a task and never miss it ✨</p>
    </div>

    <form method="POST" action="index.php?c=task&a=store" enctype="multipart/form-data">

        <!-- SEMESTER -->
        <div class="form-group">
            <label>Semester</label>
            <select id="semester" required>
                <option value="">-- Select Semester --</option>
                <?php foreach ($semesters as $s): ?>
                    <option value="<?= $s['id_semester'] ?>">
                        <?= $s['nama_semester'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- COURSE -->
        <div class="form-group">
            <label>Course</label>
            <select name="id_pengampu" id="course" required>
                <option value="">-- Select Course --</option>
            </select>
        </div>
        <!-- LECTURER -->
        <div class="form-group">
            <label>Lecturer</label>
            <p id="lecturer" class="lecturer-box">-</p>
        </div>
        <!-- TASK NAME -->
        <div class="form-group">
            <label>Task Name</label>
            <input type="text" name="task_name" placeholder="e.g. Finish UI Design" required>
        </div>

        <!-- DEADLINE -->
        <div class="form-row">
            <div class="form-group">
                <label>Deadline Date</label>
                <input type="date" name="deadline" required min="<?= date('Y-m-d') ?>">
            </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="pending">Pending</option>
                <option value="done">Done</option>
            </select>
        </div>
    </div>


        <!-- DESCRIPTION -->
        <div class="form-group">
            <label>Description (optional)</label>
            <textarea name="description" placeholder="Task details..."></textarea>
        </div>

        <!-- BUTTON -->
        <div class="actions">
            <button type="submit" class="btn save">Save Task</button>
            <a href="index.php?c=dashboard&a=index" class="btn cancel">Cancel</a>
        </div>

    </form>

</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const semesterSelect = document.getElementById('semester');
    const courseSelect   = document.getElementById('course');
    const lecturerBox    = document.getElementById('lecturer');

    // Semester → Course
    semesterSelect.addEventListener('change', function () {
        const semesterId = this.value;

        if (!semesterId) {
            courseSelect.innerHTML = '<option value="">-- Select Course --</option>';
            lecturerBox.textContent = '-';
            return;
        }

        courseSelect.innerHTML = '<option>Loading course...</option>';

        fetch(`index.php?c=task&a=getCourses&semester_id=${semesterId}`)
            .then(res => res.json())
            .then(data => {
                courseSelect.innerHTML = '<option value="">-- Select Course --</option>';

                data.forEach(course => {
                    const opt = document.createElement('option');
                    opt.value = course.id_pengampu;
                    opt.textContent = course.nama_matakuliah;
                    courseSelect.appendChild(opt);
                });
            });
    });

    // Course → Lecturer
    courseSelect.addEventListener('change', function () {
        const pengampuId = this.value;

        if (!pengampuId) {
            lecturerBox.textContent = '-';
            return;
        }

        fetch(`ajax/get_lecturer.php?pengampu_id=${pengampuId}`)
            .then(res => res.json())
            .then(data => {
                lecturerBox.textContent = data.nama_dosen ?? '-';
            })
            .catch(() => {
                lecturerBox.textContent = '-';
            });
    });

});
</script>
</body>
</html>
