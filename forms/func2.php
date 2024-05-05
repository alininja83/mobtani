<?php
function add_numbers($number1, $number2) {
    $sum = $number1 + $number2;
    return $sum;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number1 = $_POST['number1'];
    $number2 = $_POST['number2'];
    
    // فراخوانی تابع جمع اعداد
    $result = add_numbers($number1, $number2);
    echo "جمع عدد اول ($number1) و عدد دوم ($number2) برابر است با: $result";
}
echo "<a href='../index.php'>بازگشت به صفحه اصلی</a>";
?>
