<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم ثبت نام</title>
    <?php include "bootstrap_head.php";?>
</head>
<body>
    <?php include "header.php";?>
    <section id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
        <h2>فرم ثبت نام</h2>
        <form action="forms/func1.php" method="POST">
            <label for="name">نام:</label>
            <input type="text" id="name" name="name" required><br><br>
            
            <label for="email">ایمیل:</label>
            <input type="email" id="email" name="email" required><br><br>
            
            <label for="password">رمز عبور:</label>
            <input type="password" id="password" name="password" required><br><br>
            
            <input type="submit" value="ثبت نام">
        </form>
    </div>
    </section>
    <?php include "footer.php";
        include "bootstrap_body.php";
    ?>
</body>
</html>
