<?php
require_once 'config.php';
header('Content-Type: application/json; charset=UTF-8');

function generateToken() {
    $salt = 'ur_mom_fat';
    $randomBytes = random_bytes(25);
    $hexRandomBytes = bin2hex($randomBytes);
    $time = time();
    $combinedString = $hexRandomBytes . $time . md5($salt);
    $hashedToken = md5($combinedString);

    return $hashedToken;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $password_confirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : '';
    $reset_token = isset($_POST['token']) ? $_POST['token'] : '';

    if (empty($password) || empty($password_confirm) || empty($reset_token)) {
        echo json_encode(["status" => "error", "message" => "All fields are required!"]);
        exit();
    }

    if ($password !== $password_confirm) {
        echo json_encode(["status" => "error", "message" => "Passwords do not match!"]);
        exit();
    }

    $conn = connectDB();

    $stmt = $conn->prepare("SELECT email FROM user WHERE reset_token = ?");
    $stmt->bind_param("s", $reset_token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(["status" => "error", "message" => "Invalid or expired token!"]);
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $token = generateToken();
    $stmt = $conn->prepare("UPDATE user SET password = ?,token = ? ,reset_token = NULL WHERE reset_token = ?");
    $stmt->bind_param("sss", $hashed_password, $token, $reset_token);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(["status" => "success", "message" => "Password successfully updated!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating password. Please try again!"]);
    }

    $stmt->close();
    $conn->close();
}
?>
