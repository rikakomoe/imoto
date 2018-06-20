<?php

header('Access-Control-Allow-Origin: *');

if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
    include('./README.html');
    exit(0);
}

if(!isset($_SERVER['HTTP_DATABASE'])) {
    http_response_code(400);
    echo json_encode([
        "code" => 400,
        "result" => false,
        "msg" => "No database selected",
    ]);
    exit(0);
}

require_once('./config.php');

$dbname = $_SERVER['HTTP_DATABASE'];

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    http_response_code(500);
    echo json_encode([
        "code" => 500,
        "result" => false,
        "msg" => mysqli_connect_error(),
    ]);
    exit(0);
}

$request_body = file_get_contents('php://input');

$sql = json_decode($request_body);

$result = mysqli_query($conn, $sql);

if (!$result) {
    http_response_code(500);
    echo json_encode([
        "code" => 500,
        "result" => false,
        "msg" => mysqli_error($conn),
    ]);
    exit(0);
}

$data = [];

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        array_push($data, $row);
    }
}

echo json_encode([
    "code" => 200,
    "result" => true,
    "data" => $data,
]);

mysqli_close($conn);
