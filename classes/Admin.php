<?php
class Admin {
    // Database connection
    private $conn;
    // Table name
    private $table_name = "admininfo";

    // User properties
    public $id;
    public $password;
    public $name;

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
        $query = "SELECT id, name FROM " . $this->table_name . " WHERE name = ?";
        $stmt = $this->conn->prepare($query);

        // Bind parameters and execute query
        $stmt->bind_param("s", $this->name);
        $stmt->execute();
        $stmt->store_result();

        // Check if a user is found
        if ($stmt->num_rows > 0) {
            // Bind results
            $stmt->bind_result($this->id, $this->name);
            $stmt->fetch();
            return true;
        }

        return false;
    }

    // Method to register a new user
    public function register() {
        // Query to insert a new user
        $query = "INSERT INTO " . $this->table_name . " (name, password) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);

        // Hash the password
        $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
        // Bind parameters and execute query
        $stmt->bind_param("ss",$this->name, $hashed_password);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function adminExists() {
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
}
?>
