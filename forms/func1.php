<?php
function register_user($name, $email, $password) {
    // اینجا می‌توانید اطلاعات را به دیتابیس ارسال کنید یا عملیات دیگری انجام دهید
    // برای این مثال، ما فقط اطلاعات را نمایش می‌دهیم

    // نمایش پیام تأیید به کاربر
    echo "ثبت نام با موفقیت انجام شد!<br>";
    echo "نام: $name<br>";
    echo "ایمیل: $email<br>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // فراخوانی تابع ثبت نام
    register_user($name, $email, $password);
}

echo "<a href='../index.php'>بازگشت به صفحه اصلی</a>";
?>


