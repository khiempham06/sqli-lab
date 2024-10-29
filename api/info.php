<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); 
    echo 'Only POST requests are allowed!';
    exit;
}

function getLeaderboard($conn, $board_type, $sort_by) {
    $sortColumn = 'xp';

    switch ($sort_by) {
        case 'retention':
            $sortColumn = 'retention';
            break;
        case 'reviews':
            $sortColumn = 'cards';
            break;
        case 'time':
            $sortColumn = 'time';
            break;
        default:
            $sortColumn = 'xp';
            break;
    }

    $sql = "
    SELECT tl.id, u.username AS name, tl.xp, tl.reviews, tl.time, tl.cards, tl.retention, tl.day
    FROM leaderboard tl
    JOIN user u ON tl.user_id = u.id
    WHERE tl.type = ?
    ORDER BY $sortColumn DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $board_type);
    $stmt->execute();
    $result = $stmt->get_result();
    $leaderboardData = [];
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $leaderboardData[] = $row;
        }
        $stmt->close();
        return $leaderboardData;
    }

    $stmt->close();
    return false;
}

function getGeneral($conn, $username) {
    $sql = "
    SELECT user_data.reviews, user_data.streak_current, user_data.streak_highest, user_data.time, user_data.challengexp, user.fb_link 
    FROM user 
    INNER JOIN user_data ON user.id=user_data.user_id 
    WHERE user.username = '$username'";

    $result = $conn->query($sql);
    $data = [];
    
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    
    return $data;
}

header('Content-Type: application/json; charset=UTF-8');

$conn = connectDB();
$type = isset($_POST['type']) ? trim($_POST['type']) : '';

if (empty($type)) {
    echo json_encode(["status" => "error"]);
    exit();
}

if ($type === 'general') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    if (empty($username)) {
        echo json_encode(["status" => "error"]);
        exit();
    }

    $data = getGeneral($conn, $username);
    echo json_encode($data ? $data : ["status" => "error"]);
}

elseif ($type === 'leaderboard') {
    $boardType = isset($_POST['board_type']) ? trim($_POST['board_type']) : '';
    $sortBy = isset($_POST['sort_by']) ? trim($_POST['sort_by']) : 'xp';

    if (empty($boardType)) {
        echo json_encode(["status" => "error"]);
        exit();
    }

    $data = getLeaderboard($conn, $boardType, $sortBy);
    echo json_encode($data ? $data : ["status" => "error"]);
}

$conn->close();
?>
