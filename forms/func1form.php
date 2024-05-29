<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم ثبت نام</title>
    <?php include "../partials/bootstrap_head.php";?>
    <style>
        form {
            background-color: white;
            color: green;
            width: 500px;
            margin: auto;
            padding: 20px 0 20px 0;
            border-radius: 20px;
        }
        form label {
            display: block;
        }
        form input, form textarea {
            border: 1px solid green;
            border-radius: 10px;
            width: 60%;
        }
</style>
</head>
<body>
    <?php include "../partials/header.php";?>
    <section id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
        <h2 style="font-weight:bolder;font-size:larger;">register</h2>
        <form action="func1.php" method="POST">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required><br><br>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required><br><br>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required><br><br>
            
            <input type="submit" value="Submit" style="width: 15% !important;">
        </form>
    </div>
    </section>
    <?php include "../partials/footer.php";
        include "../partials/bootstrap_body.php";
    ?>
</body>
</html>
