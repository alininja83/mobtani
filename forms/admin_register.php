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

    if ($admin->adminExists()) {
        echo "Username already exists. Please choose a different username.";
    } else {
        if ($user->register()) {
            echo "Admin registered successfully.";
        } else {
            echo "Failed to register Admin.";
        }
    }
}
?>