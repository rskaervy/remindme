<?php
class SettingController {

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?c=auth&a=login");
            exit;
        }

        include '../app/views/setting/index.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?c=auth&a=login");
        exit;
    }
}
