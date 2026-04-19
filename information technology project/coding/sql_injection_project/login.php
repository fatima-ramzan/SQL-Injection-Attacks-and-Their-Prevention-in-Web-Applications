<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "File reached ✔<br>";

$conn = new mysqli("localhost", "root", "", "login_db");

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "POST received ✔<br>";

    $user = $_POST['username'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $user, $pass);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h2>Login Successful ✔</h2>";
    } else {
        echo "<h2>Login Failed ❌</h2>";
    }

    $stmt->close();
} else {
    echo "No POST request received ❗";
}

$conn->close();
?>