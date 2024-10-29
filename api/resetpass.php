<?php
require_once 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
require_once 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';

$mail = new PHPMailer();
$mail->IsSMTP(); 
$mail->SMTPAuth = true; 
$mail->SMTPSecure = 'tls'; 
$mail->Host = "smtp.mailersend.net";
$mail->Port = 587;
$mail->Username = "lmao";
$mail->Password = "lmao";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); 
    echo 'Only POST requests are allowed!';
    exit;
}

function userExist($conn, $username, $email) {
    $sql = "SELECT email FROM user WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user['email'];
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
$email = null;

if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
    $email = $username;
}
if (empty($username) && empty($email)) {
    echo json_encode(["status" => "error", "message" => "Please enter your username or email!"]);
    exit();
}

$emaill = userExist($conn, $username, $email);

if ($emaill) {
    $reset_token = generateToken();
    $sql = "UPDATE user SET reset_token = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $reset_token, $emaill);
    $stmt->execute();
        
    $mail->SetFrom("lmao@local.com", "no-reply"); 
    $mail->Subject = "Reset your password";
    $verifyLink = "http://localhost/resetpass.php?token=" . $reset_token;
    $mail->Body = "Please click the link to reset your password: <a href='$verifyLink'>$verifyLink</a>";
    $mail->isHTML(true);
    $mail->AddAddress($emaill);
    $mail->Send();
    
    echo json_encode(["status" => "sucess", "message" => "Please follow instruction in your email to reset password!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Username or email does not exist!"]);
}

$conn->close();
?>