<?php
require_once '../classes/Database.php';
require_once '../classes/User.php';     

$db = new Database();
$conn = $db->getConnection();

if(isset($_POST['addSeller'])) {
    // insert data into database
    $user = new User($db);
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    if ($user->userExists()) {
        echo "Username already exists. Please choose a different username.";
    } else {
        if ($user->register()) {
            echo "User registered successfully.";
        } else {
            echo "Failed to register user.";
        }
    }
    header("refresh:3;url=../admin/admin_panel.php");
    echo "<p>You will be redirected to the admin panel in 3 seconds...</p>";
} 
?>