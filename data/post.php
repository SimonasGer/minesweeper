<?php
require_once "Database.php";
require_once "Score.php";

header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
    echo json_encode(["status" => "error", "message" => "No data received"]);
    exit;
}
$name = $data["name"] ?? "Guest";
$time = $data["time"] ?? 0;
$bombsFound = $data["bombsFound"] ?? 0;
$bombsAll = $data["bombsAll"] ?? 0;
$win = $data["win"] ? 1 : 0;
$boardSize = $data["boardSize"] ?? 0;
$score = new Score();
$success = $score->saveScore($name, $time, $bombsFound, $bombsAll, $win, $boardSize);
if ($success) {
    echo json_encode(["status" => "success", "message" => "Score saved successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to save score"]);
}
