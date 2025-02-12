<?php
require_once "Database.php";

class Score {
    private $conn;
    public function __construct() {
        $database = new Database();
        $this->conn = $database->conn;
    }
    public function saveScore($name, $time, $bombsFound, $bombsAll, $win, $boardSize) {
        if (strlen($name) > 20) {
            return ["status" => "error", "message" => "Name must be less than 20 characters."];
        }
        try {
            $name = !empty($name) ? $name : "Guest";
            $stmt = $this->conn->prepare("INSERT INTO scores (name, time, bombs_found, bombs_all, win, board_size) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("siiiii", $name, $time, $bombsFound, $bombsAll, $win, $boardSize);
            $stmt->execute();
            return ["status" => "success", "message" => "User created successfully."];
        } catch (Exception $e) {
            return ["status" => "error", "message" => $e->getMessage()];
        }
        
    }
    public function getAllScores() {
        $result = $this->conn->query("SELECT * FROM scores ORDER BY created_at DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}