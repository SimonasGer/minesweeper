<?php
$mineTiles = [];
$tiles = [];
$numbers = [];

$height = $_GET["height"] ?? 0;
$width = $_GET["width"] ?? 0;
$bombs = $_GET["bombs"] ?? 0;

for ($i = 0; $i < $height; $i++) { 
    for ($j = 0; $j < $width; $j++) {
        $tile = "$i-$j";
        $mineTiles[] = $tile;
        $tiles[] = $tile;
    }
}

shuffle($mineTiles);
$mineTiles = array_slice($mineTiles, 0, $bombs);

foreach ($tiles as $tile) {
    if (in_array($tile, $mineTiles)) {
        $numbers[$tile] = "";
        continue;
    }

    [$tens, $ones] = array_map('intval', explode("-", $tile));
    $number = 0;

    for ($j = $tens - 1; $j <= $tens + 1; $j++) { 
        for ($k = $ones - 1; $k <= $ones + 1; $k++) { 
            $nr = "$j-$k";
            if (in_array($nr, $mineTiles)) {
                $number++;
            }
        }
    }

    $numbers[$tile] = $number > 0 ? $number : "";
}
