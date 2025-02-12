<?php
require_once "data/Score.php";

$score = new Score();
$scores = $score->getAllScores();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="leaderboard.css">
</head>
<body>
    
    <?php include "includables/header.php"; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Time</th>
                <th>Win/Lose</th>
                <th>Bombs Cleared</th>
                <th>Board size</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($scores as $s): ?>
                <tr>
                    <td><?= $s["id"] ?></td>
                    <td><?= htmlspecialchars($s["name"]) ?></td>
                    <td><?= $s["time"] ?></td>
                    <td><?= $s["win"] ?></td>
                    <td><?= $s["bombs_found"] ?>/<?= $s["bombs_all"] ?></td>
                    <td><?= $s["board_size"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php include "includables/footer.php"; ?>
    
</body>
</html>