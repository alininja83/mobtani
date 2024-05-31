<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <?php include "../partials/bootstrap_head.php" ?>
</head>

<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: forms/login.php");
    exit();
}



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

$sql = "SELECT * FROM `userinfo`"; // دستور SQL برای دریافت نام و ایمیل از جدول Userinfo
$result = $conn->query($sql);

// بستن اتصال
//$conn->close();
?>

<body>
    <nav class="navbar">
        <div class="left">
            <ul class="nav-links">
                <li><a href="index.php">show site</a></li>
                <li><a href="#seller">Seller</a></li>
                <li><a href="#product">Product</a></li>
            </ul>
        </div>
        <div class="center" style="font-size: 1.2rem; font-weight: bold; color: #fff; margin-top: 1rem;">
            <?php echo "Welcome to the admin panel, " . $_SESSION['username'] . "!";?>
            </div>
        <div class="right">
            <div class="profile">
                <div class="profile-menu">
                    <a href="#">Profile</a>
                    <a href="#">Setting</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="content">
        <div class="left-side" id="seller">
            <div class="title">
                <h2>Seller</h2>
                <form action="../forms/admin_add_seller.php" method="POST" style="display: none">
                    <input type="text" name="name" placeholder="name" required><br>
                    <input type="email" name="email" placeholder="email" required><br>
                    <input type="password" name="password" placeholder="password" required><br>
                    <input type="submit" name="addSeller" value="Add Seller">
                </form>
                <a href="#" onclick="document.querySelector('form').style.display = 'block'">Add Seller</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Seller Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // خروجی هر سطر از نتایج
                        while($row = $result->fetch_assoc()) {
                            echo " 
                            <tr>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["email"] . "</td>
                            <td>
                            <a role='button' href='' class='btn btn-danger'>Delete</a>
                            <a role='button' href='../forms/edit.php' class='btn btn-warning'>Edit</a>
                            </td>
                            </tr>
                            ";
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>

        <div class="right-side" id="product">
            <div class="title">
                <h2 class="mt-5">Product</h2>
                <a href="#">Add Product</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Product 1</td>
                        <td>$100</td>
                        <td>
                            <a href="#"><i class="fas fa-edit"></i></a>
                            <a href="#"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Product 2</td>
                        <td>$200</td>
                        <td>
                            <a href="#"><i class="fas fa-edit"></i></a>
                            <a href="#"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Product 3</td>
                        <td>$300</td>
                        <td>
                            <a href="#"><i class="fas fa-edit"></i></a>
                            <a href="#"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <?php include "../partials/bootstrap_body.php" ?>
</body>

</html>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .navbar {
        background-color: #333;
        color: #fff;
        padding: 10px;
    }

    .navbar a {
        color: #fff;
        text-decoration: none;
        margin-right: 10px;
    }

    .content {
        margin: 20px;
    }

    .content h2 {
        margin-bottom: 10px;
    }

    .content a {
        margin-left: 10px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .fas {
        margin-right: 5px;
    }
    .profile-menu a{
        :active {
            color :blue;
        }
    }
</style>
