<?php
function register_user($name, $email, $paswd) {
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
    // echo "connected successfully<br>";
    // اینجا می‌توانید اطلاعات را به دیتابیس ارسال کنید یا عملیات دیگری انجام دهید
    $sql = "INSERT INTO  Userinfo(name, email, password)  
    VALUES ('$name', '$email', '$paswd')";

    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully<br>";
    } else {
        echo "Error inserting data:" . mysqli_error($conn);
    }

    // بستن اتصال
    mysqli_close($conn);


    // نمایش پیام تأیید به کاربر
    // echo "Submited successfully<br>";
    echo "name: $name<br>";
    echo "email: $email<br>";
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $paswd = $_POST['password'];
    
    // فراخوانی تابع ثبت نام
    register_user($name, $email, $paswd);
}

echo "<a href='../index.php'>Return to main page</a>";
?>


