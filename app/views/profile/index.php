<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Profile | RemindMe</title>

<style>
* { box-sizing: border-box; font-family: Arial, sans-serif; }
body { margin:0; background:#f4f6fb; }

.profile-container {
    max-width: 480px;
    margin: 80px auto;
    background: white;
    padding: 36px;
    border-radius: 22px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

.profile-header {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 30px;
}

.avatar {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: #3F5BD8;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    font-weight: bold;
}

.profile-header h2 {
    margin: 0;
    color: #3F5BD8;
}

.profile-item {
    display: flex;
    justify-content: space-between;
    padding: 14px 0;
    border-bottom: 1px solid #eee;
}

.profile-item:last-child { border-bottom: none; }

.profile-actions {
    display: flex;
    justify-content:center;
    gap: 14px;
    margin-top: 32px;
}

.btn {
    padding: 12px 22px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: bold;
    min-width: 120px;
    text-align: center;
    transition: 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
}

.edit {
    background: #3F5BD8;
    color: white;
}

.logout {
    background: #e74c3c;
    color: white;
}

.back {
    background: #eaeefe;
    color: #3F5BD8;
}
</style>
</head>
<body>

<div class="profile-container">

    <div class="profile-header">
        <div class="avatar">
            <?= strtoupper(substr($_SESSION['user_name'], 0, 1)) ?>
        </div>
        <div>
            <h2><?= $_SESSION['user_name'] ?></h2>
            <p><?= $_SESSION['user_email'] ?? 'user@email.com' ?></p>
        </div>
    </div>

    <div class="profile-item">
        <span>Full Name</span>
        <span><?= $_SESSION['user_name'] ?></span>
    </div>

    <div class="profile-item">
        <span>Email</span>
        <span><?= $_SESSION['user_email'] ?? '-' ?></span>
    </div>

    <div class="profile-actions">
        <a href="index.php?c=profile&a=edit" class="btn edit">Edit Profile</a>
        <a href="index.php?c=profile&a=logout" class="btn logout">Logout</a>
        <a href="index.php?c=dashboard&a=index" class="btn back">← Dashboard</a>
    </div>

</div>

</body>
</html>
