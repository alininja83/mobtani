<?php
$servername = "localhost"; // نام سرور
$username = "root"; // نام کاربری پایگاه داده
$password = ""; // رمز عبور پایگاه داده
$dbname = "Users"; // نام پایگاه داده که ایجاد کرده‌اید

// اتصال به پایگاه داده
$conn = mysqli_connect($servername, $username, $password, $dbname);

// بررسی اتصال
if (!$conn) {
    die("failed to connect:" . mysqli_connect_error());
}
if(isset($_POST['addSeller'])) {
    // insert data into database
    mysqli_query($conn, "INSERT INTO `userinfo` (`name`, `email`, `password`) VALUES ('".$_POST['name']."', '".$_POST['email']."', '".$_POST['password']."')");
    header("Location: ../admin_panel.php");
} 
?>