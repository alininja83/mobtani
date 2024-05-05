<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم جمع اعداد</title>
    <?php include "bootstrap_head.php";?>
</head>
<body>
    <?php include "header.php";?>
<section id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
    <h2>فرم جمع اعداد</h2>
    <form action="forms/func2.php" method="POST">
        <label for="number1">عدد اول:</label>
        <input type="number" id="number1" name="number1" required><br><br>
        
        <label for="number2">عدد دوم:</label>
        <input type="number" id="number2" name="number2" required><br><br>
        
        <input type="submit" value="جمع اعداد">
    </form>
    </div>
</section>
    <?php include "footer.php";
        include "bootstrap_body.php";
    ?>
</body>
</html>
