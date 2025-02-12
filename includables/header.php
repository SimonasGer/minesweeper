<header>
    <h1>Minesweeper</h1>
    <a href="leaderboard.php">Leaderboard</a>
    <nav>
        <p>Time: </p>
        <p class="bombCount" data-php="<?php echo htmlspecialchars($bombs, ENT_QUOTES, 'UTF-8'); ?>">Bombs Left:?></p>
        <a class="quit" href="index.php">Quit</a>
    </nav>
</header>
