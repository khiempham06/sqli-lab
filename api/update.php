<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); 
    echo 'Only POST requests are allowed!';
    exit;
}

function verify($conn, $token) {
    $sql = "SELECT id FROM user WHERE token = ? AND verify = 1 AND active = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $stmt->close();
        return true;
    }
    $stmt->close();
    return false;
}


function getUser($conn, $token) {
    $sql = "SELECT id FROM user WHERE token = ? AND active = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $stmt->close();
        return $row['id'];
    }
    
    $stmt->close();
    return false;
}


function updateGeneral($conn, $userId, $params) {
    $set_clause = [];
    $bind_params = [];
    $bind_types = '';

    if (isset($params['reviews'])) {
        $set_clause[] = 'reviews = ?';
        $bind_params[] = $params['reviews'];
        $bind_types .= 'i';
    }
    if (isset($params['streak_current'])) {
        $set_clause[] = 'streak_current = ?';
        $bind_params[] = $params['streak_current'];
        $bind_types .= 'i';
    }
    if (isset($params['streak_highest'])) {
        $set_clause[] = 'streak_highest = ?';
        $bind_params[] = $params['streak_highest'];
        $bind_types .= 'i';
    }
    if (isset($params['time'])) {
        $set_clause[] = 'time = ?';
        $bind_params[] = $params['time'];
        $bind_types .= 'd';
    }
    if (isset($params['challengexp'])) {
        $set_clause[] = 'challengexp = ?';
        $bind_params[] = $params['challengexp'];
        $bind_types .= 'd';
    }
    if (isset($params['streak_date'])) {
        $set_clause[] = 'streak_date = ?';
        $bind_params[] = $params['streak_date'];
        $bind_types .= 's';
    }
    if (isset($params['first'])) {
        $set_clause[] = 'first = ?';
        $bind_params[] = $params['first'];
        $bind_types .= 'i';
    }

    if (count($set_clause) > 0) {
        $sql = "UPDATE user_data SET " . implode(', ', $set_clause) . " WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $bind_params[] = $userId;
        $bind_types .= 'i';
        $stmt->bind_param($bind_types, ...$bind_params);
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }

        $stmt->close();
        return false;
    } else {
        return false;
    }
}

function updateLeaderboard($conn, $userId, $params) {
    $set_clause = [];
    $bind_params = [];
    $bind_types = '';

    if (isset($params['reviews'])) {
        $set_clause[] = 'reviews = ?';
        $bind_params[] = $params['reviews'];
        $bind_types .= 'i';
    }
    if (isset($params['time'])) {
        $set_clause[] = 'time = ?';
        $bind_params[] = $params['time'];
        $bind_types .= 'd';
    }
    if (isset($params['xp'])) {
        $set_clause[] = 'xp = ?';
        $bind_params[] = $params['xp'];
        $bind_types .= 'd';
    }
    if (isset($params['cards'])) {
        $set_clause[] = 'cards = ?';
        $bind_params[] = $params['cards'];
        $bind_types .= 'i';
    }
    if (isset($params['retention'])) {
        $set_clause[] = 'retention = ?';
        $bind_params[] = $params['retention'];
        $bind_types .= 'd';
    }
    if (count($set_clause) > 0) {
        $sql = "UPDATE leaderboard SET " . implode(', ', $set_clause) . " WHERE user_id = ? AND type = ?";
        $stmt = $conn->prepare($sql);
        $bind_params[] = $userId;
        $bind_params[] = $params['board_type'];
        $bind_types .= 'is';
        $stmt->bind_param($bind_types, ...$bind_params);
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }

        $stmt->close();
        return false;
    } else {
        return false;
    }
}

function getData($conn, $userId) {
    $sql1 = "
    SELECT reviews, time, streak_current, streak_highest, streak_date, first 
    FROM user_data 
    WHERE user_id = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("i", $userId);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    $userData = $result1->fetch_assoc();
    $stmt1->close();

    $sql2 = "
    SELECT cards, time 
    FROM leaderboard 
    WHERE user_id = ? AND type = 'today'";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("i", $userId);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $leaderboardData = $result2->fetch_assoc();
    $stmt2->close();

    $userData['leaderboard_cards'] = $leaderboardData['cards'];
    $userData['leaderboard_time'] = $leaderboardData['time'];
    return $userData;
}

function formatDateTime($value) {
    if ($value instanceof DateTime) {
        return $value->format('Y-m-d');
    } else {
        return $value; 
    }
}

function process($conn, $userId, $pre_reviews, $pre_time) {
    $data = getData($conn, $userId);

    $streak_current = intval($data['streak_current']);
    $streak_mx = intval($data['streak_highest']);
    $reviews = intval($data['reviews']) + ($pre_reviews - $data['leaderboard_cards']);
    $time = floatval($data['time']) + ($pre_time - $data['leaderboard_time']);
    $first = intval($data['first']);
    $streak_date = $data['streak_date'];
    
    if($first === 0) {
        $first = 1;

        $currentDate = new DateTime(date('Y-m-d')); 
        $streakDate = new DateTime(date('Y-m-d', strtotime($streak_date))); 

        $interval = $currentDate->diff($streakDate);

        if ($interval->days <= 1) {
           $streak_current++;
           $streak_mx = max($streak_mx, $streak_current);
        } else if($interval->days > 1){
           $streak_mx = max($streak_mx, $streak_current);
           $streak_current = 1;
        }
        $streak_date = $currentDate;
    }

    $params = [
        'reviews' => $reviews,           
        'streak_current' => $streak_current,     
        'streak_highest' => $streak_mx,     
        'time' => $time,           
        'first' => $first,
        'streak_date' => formatDateTime($streak_date)
    ];
    updateGeneral($conn, $userId, $params);
}

header('Content-Type: application/json; charset=UTF-8');

$conn = connectDB();
$token = isset($_POST['token']) ? trim($_POST['token']) : '';
$type = isset($_POST['type']) ? trim($_POST['type']) : '';
if (empty($token) || empty($type) || !verify($conn, $token)) {
    echo json_encode(["status" => "error"]);
    exit();
}

$userId = getUser($conn, $token);

if (!$userId) {
    echo json_encode(["status" => "error"]);
    exit();
}

if ($type === 'general') {
    $params = [
        'reviews' => isset($_POST['reviews']) ? $_POST['reviews'] : null,
        'streak_current' => isset($_POST['streak_current']) ? $_POST['streak_current'] : null,
        'streak_highest' => isset($_POST['streak_highest']) ? $_POST['streak_highest'] : null,
        'time' => isset($_POST['time']) ? $_POST['time'] : null,
        'challengexp' => isset($_POST['challengexp']) ? $_POST['challengexp'] : null
    ];

    if (updateGeneral($conn, $userId, $params)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
}  elseif ($type === 'leaderboard') {
    $board_type = isset($_POST['board_type']) ? trim($_POST['board_type']) : '';
    if(empty($board_type)) {
        echo json_encode(["status" => "error"]);
        exit();
    }
    $params = [
        'reviews' => isset($_POST['reviews']) ? $_POST['reviews'] : null,
        'time' => isset($_POST['time']) ? $_POST['time'] : null,
        'xp' => isset($_POST['xp']) ? $_POST['xp'] : null,
        'cards' => isset($_POST['cards']) ? $_POST['cards'] : null,
        'retention' => isset($_POST['retention']) ? $_POST['retention'] : null,
        'day' => isset($_POST['day']) ? $_POST['day'] : null,
        'board_type' => $board_type
    ];

    $pre_reviews = $_POST['cards'];
    $pre_time = $_POST['time'];
    process($conn, $userId, $pre_reviews, $pre_time);
    if (updateLeaderboard($conn, $userId, $params)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
} else {
    echo json_encode(["status" => "error"]);
}

$conn->close();
?>
