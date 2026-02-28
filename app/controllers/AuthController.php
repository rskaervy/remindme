<?php

class AuthController {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login() {
        include '../app/views/auth/login.php';
    }

    public function doLogin() {

        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            echo "<script>alert('Email dan password wajib diisi');history.back();</script>";
            exit;
        }

        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo "<script>alert('Email tidak terdaftar');history.back();</script>";
            exit;
        }

        if (!password_verify($password, $user['password'])) {
            echo "<script>alert('Password salah');history.back();</script>";
            exit;
        }

        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['user_name'] = $user['name'];

        header("Location: index.php?c=dashboard&a=index");
        exit;
    }

    public function register() {
        include '../app/views/auth/register.php';
    }

    public function doRegister() {

        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if (empty($name) || empty($email) || empty($password)) {
            echo "<script>alert('Semua field wajib diisi');history.back();</script>";
            exit;
        }

        $check = $this->db->prepare("SELECT id_user FROM users WHERE email = ?");
        $check->execute([$email]);

        if ($check->rowCount() > 0) {
            echo "<script>alert('Email sudah terdaftar');history.back();</script>";
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare(
            "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
        );
        $stmt->execute([$name, $email, $hashedPassword]);

        echo "<script>alert('Register berhasil, silakan login');window.location='index.php?c=auth&a=login';</script>";
        exit;
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?c=auth&a=login");
        exit;
    }
}
