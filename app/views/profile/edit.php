<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Profile | RemindMe</title>

<style>
* { box-sizing: border-box; font-family: Arial, sans-serif; }
body {
    margin: 0;
    background: #f4f6fb;
}

.edit-container {
    max-width: 600px;
    margin: 60px auto;
    background: white;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

.edit-header {
    text-align: center;
    margin-bottom: 30px;
}

.avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #3F5BD8;
    color: white;
    font-size: 32px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 14px;
}

.edit-header h2 {
    margin: 0;
    color: #3F5BD8;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    font-size: 14px;
    margin-bottom: 6px;
    color: #555;
}

.form-group input {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #ddd;
}

.form-group input:focus {
    border: 1.5px solid #3F5BD8;
    outline: none;
}

.actions {
    display: flex;
    gap: 12px;
    margin-top: 30px;
}

.btn {
    flex: 1;
    padding: 12px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: bold;
    text-align: center;
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
</style>
</head>
<body>

<div class="edit-container">

    <div class="edit-header">
        <div class="avatar">
            <?= strtoupper(substr($_SESSION['user_name'], 0, 1)) ?>
        </div>
        <h2>Edit Profile</h2>
        <p>Update your personal information</p>
    </div>

    <form method="POST" action="index.php?c=profile&a=update">
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name"
                   value="<?= $_SESSION['user_name'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email"
                   value="<?= $_SESSION['user_email'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label>New Password (optional)</label>
            <input type="password" name="password" placeholder="••••••••">
        </div>

        <div class="actions">
            <button type="submit" class="btn save">Save Changes</button>
            <a href="index.php?c=profile&a=index" class="btn cancel">Cancel</a>
        </div>
    </form>

</div>

</body>
</html>
