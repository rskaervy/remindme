<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | RemindMe</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #3F5BD8;
            color: #333;
        }

        /* LOGIN SECTION */
        .login-wrapper {
            height:100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            background: white;
            width: 320px;            
            padding: 32px;
            border-radius: 14px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .login-card h2 {
            margin: 0 0 10px;
            font-size: 32px;         
            color: #3F5BD8;
        }

        .login-card p {
            margin-bottom: 24px;
            font-size: 14px;
            color: #777;
        }

        .login-card input {
            width: 100%;
            padding: 12px;
            margin-bottom: 14px;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: 0.2s ease;
        }

        .login-card button {
            width: 100%;
            padding: 12px;
            background: #3F5BD8;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .login-card input:focus{
            border:1.5px solid #3f5bd8;
            box-shadow: 0 0 0 2px rgba(63, 91, 216, 0.15);
            outline:none;
        }

        .login-card button:hover {
            background: #2f46b8;
        }

        .login-card .register-text {
            margin-top: 20px;
            font-size: 14px;
        }

        .login-card .register-text a {
            color: #3F5BD8;
            font-weight: bold;
            text-decoration: none;
        }

        .login-card .register-text a:hover {
            text-decoration: underline;
        }

        /* ERROR & SUCCESS STATE */
        input.error {
            border: 1.5px solid #e74c3c;
            box-shadow: 0 0 0 2px rgba(231, 76, 60, 0.15);
        }

        input.success {
            border: 1.5px solid #2ecc71;
            box-shadow: 0 0 0 2px rgba(46, 204, 113, 0.15);
        }

        .error-text {
            color: #e74c3c;
            font-size: 12px;
            text-align: left;
            margin-top: -8px;
            margin-bottom: 10px;
        }
        .show-password {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 8px;
            font-size: 13px;
            margin: 10px 0 14px;
            text-align: left;
        }

        .show-password input {
            width: auto;
            margin: 0;
        }

        .error-msg {
            background: #ffe6e6;
            color: #c0392b;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 14px;
            font-size: 14px;
}

    </style>
</head>
<body>
<?php if (!empty($_GET['error'])): ?>
<div class="error-msg">
    <?= htmlspecialchars($_GET['error']) ?>
</div>
<?php endif; ?>



<div class="login-wrapper">
    <div class="login-card">
        <h2>RemindMe</h2>
        <p>Manage tasks and receive timely <br> reminders directly via email.</p>

        <form method="POST" action="index.php?c=auth&a=doLogin">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <div class="show-password">
                <input type="checkbox" id="togglePass">
                <label for="togglePass">Show Password</label>
            </div>
            <button type="submit">Login</button>
        </form>

        <div class="register-text">
            Don’t have an account?
            <a href="index.php?c=auth&a=register">Register</a>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const password = document.getElementById('password');
    const toggle = document.getElementById('togglePass');

    console.log(password, toggle);

    toggle.addEventListener('change', function () {
        password.type = this.checked ? 'text' : 'password';
    });

});
</script>
</body>
</html>
