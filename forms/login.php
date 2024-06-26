<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/Admin.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();

    $admin = new Admin($db);
    $admin->name = $_POST['username'];
    $admin->password = $_POST['password'];

    if ($admin->login()) {
        $_SESSION['name'] = $admin->name;
        header("Location: ../admin/admin_panel.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>


