<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "login_db");

if ($conn->connect_error) {
    die("Connection failed");
}

$user = $_POST['username'];
$pass = $_POST['password'];

/* ❌ VULNERABLE SQL (this allows SQL injection) */
$sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Login Successful (Vulnerable) ✔</h2>";
} else {
    echo "<h2>Login Failed ❌</h2>";
}
?>