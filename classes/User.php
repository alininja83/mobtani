<?php
class User {
    // Database connection
    private $conn;
    // Table name
    private $table_name = "userinfo";

    // User properties
    public $id;
    public $password;
    public $name;
    public $email;
    public $new_name;
    public $new_email;
    public $new_password;

    // Constructor with database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to log in a user
    public function login() {
        // Query to find the user by username
        $query = "SELECT id, password FROM " . $this->table_name . " WHERE name = ?";
        $stmt = $this->conn->prepare($query);

        // Bind parameters and execute query
        $stmt->bind_param("s", $this->name);
        $stmt->execute();
        $stmt->store_result();

        // Hash the password
        $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);

        // Check if a user is found
        if ($stmt->num_rows > 0) {
            // Bind results and compare hashed password
            $stmt->bind_result($this->id, $hashed_password);
            $stmt->fetch();

            if (password_verify($this->password, $hashed_password)) {
                return true;
            }
        }

        return false;
    }

    // Method to get user information
    public function getUserInfo() {
        // Query to find user information by username
        $query = "SELECT id, name, email FROM " . $this->table_name . " WHERE name = ?";
        $stmt = $this->conn->prepare($query);

        // Bind parameters and execute query
        $stmt->bind_param("s", $this->name);
        $stmt->execute();
        $stmt->store_result();

        // Check if a user is found
        if ($stmt->num_rows > 0) {
            // Bind results
            $stmt->bind_result($this->id, $this->name, $this->email);
            $stmt->fetch();
            return true;
        }

        return false;
    }

    // Method to update user information
    public function update($id) {
        // Query to update user information
        $query = "UPDATE " . $this->table_name . " SET name = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // Hash the new password
        $hashed_password = password_hash($this->new_password, PASSWORD_BCRYPT);
        // Bind parameters and execute query
        $stmt->bind_param("ssss", $this->new_name, $this->new_email, $hashed_password, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Method to register a new user
    public function register() {
        // Query to insert a new user
        $query = "INSERT INTO " . $this->table_name . " (name, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        // Hash the password
        $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
        // Bind parameters and execute query
        $stmt->bind_param("sss",$this->name, $this->email, $hashed_password);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function userExists() {
        // کوئری برای بررسی وجود کاربر بر اساس نام کاربری
        $query = "SELECT id FROM " . $this->table_name . " WHERE name = ?";
        $stmt = $this->conn->prepare($query);

        // بایند کردن نام کاربری و اجرای کوئری
        $stmt->bind_param("s", $this->name);
        $stmt->execute();
        $stmt->store_result();

        // بررسی اینکه آیا کاربری با این نام کاربری وجود دارد
        if ($stmt->num_rows > 0) {
            return true;
        }

        return false;
    }

    public function delete() {
        // کوئری برای حذف کاربر بر اساس نام کاربری
        $query = "DELETE FROM " . $this->table_name . " WHERE name = ?";
        $stmt = $this->conn->prepare($query);
        // بایند کردن نام کاربری و اجرای کوئری
        $stmt->bind_param("s", $this->name);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function getAllUsers() {
        $query = "SELECT id, name, email FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}
?>
