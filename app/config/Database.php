<?php

try {
    $db = new PDO(
        "mysql:host=localhost;dbname=reminder_app;charset=utf8",
        "root",
        ""
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $GLOBALS['db'] = $db; 
} catch (PDOException $e) {
    die("DB ERROR: " . $e->getMessage());
}
