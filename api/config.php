<?php

$dbConfig = [
    'servername' => 'localhost',
    'username' => 'test_db',
    'password' => 'test',
    'dbname' => 'ankivnco_leaderboard_test',
];

function connectDB() {
    global $dbConfig;
    $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);
    if ($conn->connect_error) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
        exit();
    }
    return $conn;
}
?>
