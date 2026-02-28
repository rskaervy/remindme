<?php
class ProfileController {

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?c=auth&a=login");
            exit;
        }

        include '../app/views/profile/index.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?c=auth&a=login");
        exit;
    }

    public function edit() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?c=auth&a=login");
            exit;
        }

        include '../app/views/profile/edit.php';
    }
    
    public function update() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?c=auth&a=login");
        exit;
    }

    $name  = $_POST['name'];
    $email = $_POST['email'];

    $_SESSION['user_name']  = $name;
    $_SESSION['user_email'] = $email;

    header("Location: index.php?c=profile&a=index");
    exit;
}


}
