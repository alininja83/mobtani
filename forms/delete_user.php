<?php
session_start();

// اطمینان حاصل کنید که کاربر وارد شده است
if (!isset($_SESSION['name'])) {
    header("Location: ../forms/login.php");
    exit();
}


require_once '../classes/Database.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $db = new Database();
    $conn = $db->getConnection();

    // حذف کاربر با استفاده از شناسه کاربر
    $sql = "DELETE FROM userinfo WHERE ID=" . $_GET['id'];

    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully";
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    // بستن اتصال
    $conn->close();

    // هدایت به صفحه پنل ادمین بعد از 3 ثانیه
    header("refresh:3;url=../admin/admin_panel.php");
    echo "<p>You will be redirected to the admin panel in 3 seconds...</p>";
} else {
    echo "Invalid user ID";
}
?>
