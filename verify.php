<?php
require_once 'api/config.php';
$conn = connectDB();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $sql = "SELECT * FROM user WHERE reg_token = ? AND verify = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $sql = "UPDATE user SET verify = 1, reg_token = NULL WHERE reg_token = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $token);
        $stmt->execute();

        header('Location: login.html');
        exit();
    } else {
        echo "Invalid or expired token.";
    }
} else {
    echo "No token provided.";
}
?>