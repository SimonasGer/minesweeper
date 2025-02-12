<?php
require "includables/logic.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minesweeper</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>

    <?php include "includables/header.php"; ?>
    <?php include "includables/modal.php"; ?>

    <form class="playForm" action="index.php" method="get">
        <label>Height</label>
        <input type="number" name="height">
        <label>Width</label>
        <input type="number" name="width">
        <label>Bombs</label>
        <input type="number" name="bombs">
        <button class="play" type="submit">Play</button>
    </form>

    <?php include "includables/board.php"; ?>

    <?php include "includables/footer.php"; ?>

    <script src="script.js"></script>
</body>
</html>
