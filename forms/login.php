<?php
session_start();
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "Users";

// اتصال به پایگاه داده
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// بررسی اتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "SELECT ID, password FROM Admininfo WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['userid'] = $id;
            $_SESSION['username'] = $username;
            header("Location: ../admin/admin_panel.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }

    $stmt->close();
    $conn->close();
}
?>

