<?php
session_start();

// اطمینان حاصل کنید که کاربر وارد شده است
if (!isset($_SESSION['name'])) {
    header("Location: ../forms/login.php");
    exit();
}

require_once('../classes/Database.php');

if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['name']) && isset($_POST['email'])) {
    $db = new Database();
    $conn = $db->getConnection();

    // بررسی اتصال
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // داده‌های فرم
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    // دریافت رمز عبور فعلی
    $sql = "SELECT password FROM userinfo WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentPassword = $result->fetch_assoc()['password'];
    $stmt->close();

    // اگر رمز عبور جدید وارد شده بود، آن را هش کنید، در غیر این صورت از رمز عبور فعلی استفاده کنید
    $password = isset($_POST['password']) && !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $currentPassword;

    // به روزرسانی کاربر با استفاده از شناسه کاربر
    $sql = "UPDATE userinfo SET name=?, email=?, password=? WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $password, $id);

    if ($stmt->execute()) {
        echo "User updated successfully";
    } else {
        echo "Error updating user: " . $stmt->error;
    }

    // بستن اتصال
    $stmt->close();
    $conn->close();

    // هدایت به صفحه پنل ادمین بعد از 3 ثانیه
    header("refresh:3;url=../admin/admin_panel.php");
    echo "<p>You will be redirected to the admin panel in 3 seconds...</p>";
} else {
    echo "Invalid user ID or missing fields";
}
?>
