<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "bootstrap_head.php" ?>
    <title>Login</title>
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
<section id="hero" class="d-flex align-items-center">
<div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
    <h2>Admin Login</h2>
    <form action="forms/login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Login" class="mt-4 mb-3" style="width: 25% !important;">
    </form>
</div>
</section>
    <?php include "bootstrap_body.php" ?>
</body>
</html>

