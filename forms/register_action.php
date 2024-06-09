<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
   

    if ($user->password != $confirm_password) {
        echo "Passwords do not match.";
        header("Refresh: 3; URL=register.php");
        exit();
    }

    if ($user->userExists()) {
        echo "Username already exists. Please choose a different username.";
    } else {
        if ($user->register()) {
            echo "User registered successfully.";
        } else {
            echo "Failed to register user.";
        }
    }
}
?>

