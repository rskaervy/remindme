<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings | RemindMe</title>
    <style>
        * { box-sizing: border-box; font-family: Arial, sans-serif; }
        body { margin:0; background:#f4f6fb; }

        .container {
            max-width: 600px;
            margin: 60px auto;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }

        h2 { margin-top:0; color:#3F5BD8; }

        .item {
            display:flex;
            justify-content: space-between;
            align-items:center;
            padding: 14px 0;
            border-bottom:1px solid #eee;
        }

        .item:last-child { border-bottom:none; }

        .btn {
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration:none;
            font-weight:bold;
        }

        .logout {
            background:#e74c3c;
            color:white;
        }

        .back {
            background:#eaeefe;
            color:#3F5BD8;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Settings</h2>

    <div class="item">
        <span>Account</span>
        <span><?= $_SESSION['user_name'] ?? '' ?></span>
    </div>

    <div class="item">
        <span>Logout</span>
        <a href="index.php?c=setting&a=logout" class="btn logout">Logout</a>
    </div>

    <div class="item">
        <a href="index.php?c=dashboard&a=index" class="btn back">← Back to Dashboard</a>
    </div>
</div>

</body>
</html>
