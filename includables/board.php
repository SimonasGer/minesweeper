<table class="minefield"  oncontextmenu="return false;">
    <tbody>
        <?php for ($row = 0; $row < $height; $row++): ?>
            <tr class="row">
                <?php for ($col = 0; $col < $width; $col++): ?>
                    <td class="col">
                        <div class="content" id="<?= $row ?>-<?= $col ?>">
                            <?php
                                $mine = "$row-$col";
                                if (in_array($mine, $mineTiles)) {
                                    echo "X";
                                }
                                echo $numbers[$mine] ?? "";
                            ?>
                        </div>
                        <div class="flag"></div>
                    </td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </tbody>
</table>
