<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); 
    echo 'Only POST requests are allowed!';
    exit;
}

function userExist($conn, $username, $email) {
    $sql = "SELECT id FROM user WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $stmt->close();
        return true;
    }
    $stmt->close();
    return false;
}

function verify($conn, $username, $email) {
    $sql = "SELECT id FROM user WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $stmt->close();
        return true;
    }
    $stmt->close();
    return false;
}

function login($conn, $username, $email, $password, $loginType) {
    $sql = null;
    $stmt = null;
    if($loginType === 0) {
        $sql = "SELECT password, token FROM user WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
    }
    else {
        $sql = "SELECT password, token FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
    }

    $stmt->bind_result($hashedPassword, $token);
    $stmt->fetch();

    if (password_verify($password, $hashedPassword)) {
        $stmt->close();
        return $token;
    } else {
        $stmt->close();
        return false;
    }
}

header('Content-Type: application/json; charset=UTF-8');

$conn = connectDB();
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$loginType = 0;

if(!empty($username)) 
    $loginType = 0; 
elseif(!empty($email)) 
    $loginType = 1;
else {
    echo json_encode(["status" => "error", "message" => "Please enter your username or email!"]);
    exit();
}

if (empty($password)) {
    echo json_encode(["status" => "error", "message" => "Please enter your password!"]);
    exit();
}

if(userExist($conn, $username, $email)) {
    if(verify($conn, $username, $email)) {
    $token = login($conn, $username, $email, $password, $loginType);
    if ($token !== false) {
        setcookie("username", $username, 0, "/"); 
        setcookie("token", $token, 0, "/"); 
        echo json_encode(["status" => "success", "user" => ["username" => $username, "token" => $token]]);
    } 
    else {
        echo json_encode(["status" => "error", "message" => "Incorrect username or password!"]);
    }
    }
} 
else {
    echo json_encode(["status" => "error", "message" => "Username does not exist!"]);
}

$conn->close();
?>
