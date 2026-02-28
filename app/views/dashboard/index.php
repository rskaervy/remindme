<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | RemindMe</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #f4f6fb;
            color: #333;
        }

        .dashboard {
            padding: 30px 50px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header-actions {
            display: flex;
            gap: 12px;
        }

        .settings-btn {
            background: #eaeefe;
            color: #3F5BD8;
            padding: 12px;
            border-radius: 10px;
            font-size: 18px;
            text-decoration: none;
            transition: 0.3s;
        }

        .settings-btn:hover {
            background: #d6ddfb;
        }

        .header h1 {
            margin: 0;
            color: #3F5BD8;
        }

        .filedone-btn,
        .add-task {
            background: #3F5BD8;
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .filedone-btn:hover,
        .add-task:hover {
            background: #2f46b8;
        }


        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }

        .card h3 {
            margin: 0;
            font-size: 16px;
            color: #777;
        }

        .card p {
            margin-top: 10px;
            font-size: 32px;
            font-weight: bold;
            color: #3F5BD8;
        }

        .task-list {
            background: white;
            padding: 20px;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
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
            color: #777;
            font-size: 14px;
        }

        .edit-btn {
            font-size: 18px;
            text-decoration: none;
        }

        .edit-btn:hover {
            opacity: 0.6;
        }

        .delete-btn {
            margin-left: 10px;
            font-size: 18px;
            text-decoration: none;
        }

        .delete-btn:hover {
            opacity: 0.6;
        }

        .logout-btn {
            background: #f44336;
            color: white;
            padding: 12px 16px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
        transition: 0.3s;
        }

        .logout-btn:hover {
            background: #d32f2f;
        }

        table tr:hover {
            background: #f9faff;
            transition: 0.2s;
        }

        .add-task,
        .settings-btn,
        .logout-btn,
        .filedone-btn{
            transition: 0.2s ease;
        }

        .add-task:hover,
        .settings-btn:hover,
        .logout-btn:hover,
        .filedone-btn:hover{
            transform: translateY(-2px);
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            display: inline-block;
        }

        .status-badge.done {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-badge.pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .alert {
            background: #fee2e2;
            color: #991b1b;
            padding: 14px 18px;
            border-radius: 14px;
            margin-bottom: 25px;
            font-weight: bold;
        }

        @media (max-width: 768px) {

            .dashboard {
                padding: 20px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .header-actions {
                flex-wrap: wrap;
                gap: 10px;
            }

            .add-task,
            .filedone-btn,
            .logout-btn {
                width: 100%;
                text-align: center;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .task-list {
                overflow-x: auto;
            }

            table {
                min-width: 700px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>

<div class="dashboard">
    <div class="header">
        <div>
            <h1>Hi, <?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?>! 👋</h1>
            <p>Let’s manage your tasks today</p>
        </div>

        <div class="header-actions">
            <a href="/remindme/app/reminder/send_email.php" class="filedone-btn">📧 Send Reminder Email</a>
            <a href="index.php?c=task&a=create" class="add-task">+ Add Task</a>
            <a href="index.php?c=file&a=index" class="filedone-btn">📁 File Task</a>
            <a href="index.php?c=profile&a=index" class="settings-btn">⚙️</a>
            <a href="index.php?c=auth&a=logout" class="logout-btn">Logout</a>
        </div>
    </div>
    <?php if (!empty($notif) && $notif['total'] > 0): ?>
        <div class="alert">
            ⚠️ Reminder: <?= $notif['total'] ?> task(s) need your attention today!
        </div>
    <?php endif; ?>

    <div class="stats">
        <div class="card">
            <h3>Total Tasks</h3>
            <p><?= $totalTasks ?></p>
        </div>
        <div class="card">
            <h3>Completed</h3>
            <p><?= $completedTasks ?></p>
        </div>
        <div class="card">
            <h3>Pending</h3>
            <p><?= $pendingTasks ?></p>
        </div>
    </div>

    <div class="task-list">
        <table>
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Lecturer</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($tasks)): ?>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= htmlspecialchars($task['nama_matakuliah'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($task['nama_dosen'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($task['deadline']) ?></td>
                        <td>
                            <span class="status-badge <?= htmlspecialchars($task['status']) ?>">
                                <?= htmlspecialchars(ucfirst($task['status'])) ?>
                        </span>
                        </td>
                        <td>
                            <a class="edit-btn" href="index.php?c=task&a=edit&id=<?= $task['id_tugas'] ?>">✏️</a>
                            <a class="delete-btn" href="index.php?c=task&a=delete&id=<?= $task['id_tugas'] ?>" onclick="return confirm('Are you sure want to delete this task?')">🗑️</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center; padding:40px; color:#888;">
                    <p style="font-size:18px;">📭 No tasks yet</p>
                    <p>Click <b>+ Add Task</b> to get started</p>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
