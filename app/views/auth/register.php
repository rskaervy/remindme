<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | RemindMe</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #3F5BD8;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-card {
            background: white;
            width: 320px;            
            padding: 32px;
            border-radius: 14px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .register-card h2 {
            margin: 0 0 10px;
            font-size: 32px;
            color: #3F5BD8;
        }

        .register-card p {
            margin-bottom: 24px;
            font-size: 14px;
            color: #777;
        }

        .register-card input {
            width: 100%;
            padding: 12px;
            margin-bottom: 14px;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition:0.2s ease;
        }

        .register-card input:focus {
            border: 1.5px solid #3f5bd8;
            box-shadow: 0 0 0 2px rgba(63, 91, 216, 0.15);
            outline: none;
        }


        .register-card button {
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

        .register-card button:hover {
            background: #2f46b8;
        }

        .register-card .login-text {
            margin-top: 20px;
            font-size: 14px;
        }

        .register-card .login-text a {
            color: #3F5BD8;
            font-weight: bold;
            text-decoration: none;
        }

        .register-card .login-text a:hover {
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

    </style>
</head>
<body>

<div class="register-card">
    <h2>Register</h2>
    <p>Create your account to get started.</p>

    <form method="POST" action="index.php?c=auth&a=doRegister">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" required>
        <div id="errorMsg" class="error-text"></div>
        <div class="show-password">
            <input type="checkbox" id="togglePass">
            <label for="togglePass">Show Password</label>
        </div>
        <button type="submit">Register</button>
    </form>

    <div class="login-text">
        Already have an account?
        <a href="index.php?c=auth&a=login">Login</a>
    </div>
</div>
<script>
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    const errorMsg = document.getElementById('errorMsg');

    confirmPassword.addEventListener('input', () => {
        if (confirmPassword.value === "") {
            confirmPassword.classList.remove('error', 'success');
            errorMsg.textContent = "";
        return;
        }

        if (password.value !== confirmPassword.value) {
            confirmPassword.classList.add('error');
            confirmPassword.classList.remove('success');
            errorMsg.textContent = "Password does not match";
        } else {
            confirmPassword.classList.add('success');
            confirmPassword.classList.remove('error');
            errorMsg.textContent = "";
        }
    });
    document.getElementById('togglePass').addEventListener('change', function () {
        const type = this.checked ? 'text' : 'password';
        password.type = type;
        confirmPassword.type = type;
    });
    document.addEventListener('DOMContentLoaded', function () {
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');
        const toggle = document.getElementById('togglePass');

    toggle.addEventListener('change', function () {
        const type = this.checked ? 'text' : 'password';
        password.type = type;
        confirmPassword.type = type;
    });
});
</script>

</body>
</html>
