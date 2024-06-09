<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- لینک به Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: index.php");
    exit();
}

require_once('../classes/Database.php');

$db = new Database();
$conn = $db->getConnection();

$sql = "SELECT * FROM `userinfo`"; // دستور SQL برای دریافت نام و ایمیل از جدول Userinfo
$result = $conn->query($sql);

?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Show Site</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#seller">Seller</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#product">Product</a>
                </li>
            </ul>
        </div>
        <div class="navbar-text">
            <?php echo "Welcome to the admin panel, " . $_SESSION['name'] . "!";?>
        </div>
        <div class="dropdown ml-auto">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="profileMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Profile
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileMenu">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="#">Setting</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6" id="seller">
                <div class="card">
                    <div class="card-header">
                        <h2>Seller</h2>
                        <button class="btn btn-primary" onclick="document.querySelector('#addSellerForm').style.display = 'block'">Add Seller</button>
                    </div>
                    <div class="card-body">
                        <form id="addSellerForm" action="../forms/admin_add_seller.php" method="POST" style="display: none">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            <button type="submit" class="btn btn-success" name="addSeller">Add Seller</button>
                        </form>
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th>Seller Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
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
                                        <a role='button' href='#' onclick='confirmDelete(".$row['ID'].")' class='btn btn-danger btn-sm'>Delete</a>
                                        <a role='button' href='../forms/update_user.php?id=".$row['ID']."' class='btn btn-warning btn-sm'>Edit</a>
                                        </td>
                                        </tr>
                                        ";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6" id="product">
                <div class="card">
                    <div class="card-header">
                        <h2>Product</h2>
                        <button class="btn btn-primary">Add Product</button>
                    </div>
                    <div class="card-body">
                        <table class="table">
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
                                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Product 2</td>
                                    <td>$200</td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Product 3</td>
                                    <td>$300</td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- لینک به Bootstrap JS و jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = '../forms/delete_user.php?id=' + id;
            }
        }
    </script>

</body>

</html>
