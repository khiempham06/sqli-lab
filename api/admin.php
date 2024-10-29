<?php
require_once 'config.php';

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function is_ip_allowed($ip) {
    $file_path = __DIR__ . '/../ip_allow.txt';
    $allowed_ips = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return in_array($ip, $allowed_ips);
}

$ip = get_client_ip();
if (!is_ip_allowed($ip)) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'You are not an admin!']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $userId = isset($_POST['id']) ? intval($_POST['id']) : 0;

        if ($userId > 0) {
            $conn = connectDB();
            if ($action === 'activate') {
                $sql = "UPDATE user SET active = 1 WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('i', $userId);

                if ($stmt->execute()) {
                    echo json_encode(['status' => 'success']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to activate user.']);
                }

                $stmt->close();
            } elseif ($action === 'delete') {
                $conn->begin_transaction();
                try {
                    $sql = "DELETE FROM leaderboard WHERE user_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('i', $userId);
                    $stmt->execute();
                    $stmt->close();

                    $sql = "DELETE FROM user_data WHERE user_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('i', $userId);
                    $stmt->execute();
                    $stmt->close();

                    $sql = "DELETE FROM user WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('i', $userId);
                    $stmt->execute();
                    $stmt->close();

                    $conn->commit();
                    echo json_encode(['status' => 'success']);
                } catch (Exception $e) {
                    $conn->rollback();
                    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
                }
            } elseif ($action === 'deactivate') {
                $sql = "UPDATE user SET active = 0 WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('i', $userId);

                if ($stmt->execute()) {
                    echo json_encode(['status' => 'success']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to deactivate user.']);
                }

                $stmt->close();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
            }
            $conn->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid User ID']);
        }
    }
} else {
    function getUsers($conn, $status) {
        $sql = "SELECT id, username, fb_link FROM user WHERE active = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $status);
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        $stmt->close();
        return $users;
    }

    header('Content-Type: application/json; charset=UTF-8');
    $conn = connectDB();
    $status = isset($_GET['type']) ? intval($_GET['type']) : 0;
    $users = getUsers($conn, $status);
    echo json_encode($users);
    $conn->close();
}
?>
