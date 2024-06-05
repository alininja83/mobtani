<?php
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit();
}

require_once('../classes/Database.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $db = new Database();
    $conn = $db->getConnection();

    // بررسی اتصال
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // دریافت اطلاعات کاربر با استفاده از شناسه کاربر
    $sql = "SELECT * FROM userinfo WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "User not found";
        exit();
    }

    // بستن اتصال
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid user ID";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <?php include "../partials/bootstrap_head.php" ?>
</head>
<body>
    <div class="container">
        <h2>Update User</h2>
        <form action="../forms/update_user_action.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">New Password (leave blank to keep current password)</label>
                <input type="password" name="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
    <?php include "../partials/bootstrap_body.php" ?>
</body>
</html>
