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
    $confirm_password = $_POST['confirm_password'];


    if ($admin->password != $confirm_password) {
        echo "Passwords do not match.";
        header("Refresh: 3; URL=../admin/index.php");
        exit();
    }


    if ($admin->adminExists()) {
        echo "Username already exists. Please choose a different username.";
        header("Refresh: 3; URL=../admin/index.php");
    } else {
        if ($user->register()) {
            echo "Admin registered successfully.";
            header("Refresh: 3; URL=../admin/index.php");
        } else {
            echo "Failed to register Admin.";
            header("Refresh: 3; URL=../admin/index.php");
        }
    }
    
}
?>