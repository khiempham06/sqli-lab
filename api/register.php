<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); 
    echo 'Only POST requests are allowed!';
    exit;
}

function getIp() {
    if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        return $_SERVER['HTTP_CF_CONNECTING_IP'];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipAddresses = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ipAddresses[0]);
    }
    return $_SERVER['REMOTE_ADDR'];
}

function checkExist($conn, $username, $email) {
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

function generateToken() {
    $salt = 'ur_mom_fat';
    $randomBytes = random_bytes(25);
    $hexRandomBytes = bin2hex($randomBytes);
    $time = time();
    $combinedString = $hexRandomBytes . $time . md5($salt);
    $hashedToken = md5($combinedString);

    return $hashedToken;
}

header('Content-Type: application/json; charset=UTF-8');

$conn = connectDB();
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$fb = isset($_POST['fb']) ? trim($_POST['fb']) : '';

if (empty($username) || empty($email) || empty($password)) {
    echo json_encode(["status" => "error", "message" => "Please fill in all the required fields!"]);
    exit();
}
if(checkExist($conn, $username, $email)) {
    echo json_encode(["status" => "error", "message" => "Username or email already exists!"]);
    exit();
}

$password = password_hash($password, PASSWORD_BCRYPT);
$token = generateToken();
$ip = getIp();
$reg_token = generateToken();

if(!empty($fb)) {
    $sql = "INSERT INTO user (username, email, reg_token, password, token, ip, fb_link) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $username, $email, $reg_token, $password, $token, $ip, $fb);
    $stmt->execute();
}
else {
$sql = "INSERT INTO user (username, email, reg_token, password, token, ip) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $username, $email, $reg_token, $password, $token, $ip);
$stmt->execute();
}

$user_id = $conn->insert_id;

$curr = date('Y-m-d');
$sql = "INSERT INTO user_data (user_id, reviews, streak_current, streak_highest, time, challengexp, streak_date, first) VALUES (?, 0, 0, 0, 0, 0, ?, 0)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $user_id, $curr);
$stmt->execute();

$sql = "INSERT INTO leaderboard (user_id, reviews, time, xp, cards, retention, day, type) VALUES (?, 0, 0, 0, 0, 0, 1, 'today')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

$sql = "INSERT INTO leaderboard (user_id, reviews, time, xp, cards, retention, day, type) VALUES (?, 0, 0, 0, 0, 0, 0, 'week')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

$sql = "INSERT INTO leaderboard (user_id, reviews, time, xp, cards, retention, day, type) VALUES (?, 0, 0, 0, 0, 0, 0, 'challenge')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

$stmt->close();
$conn->close();


echo json_encode(["status" => "success", "message" => "Register successfully!"]);
?>
