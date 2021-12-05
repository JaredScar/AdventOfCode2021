<?php
function part1() {
    $input = fopen(__DIR__ . "/../inputs/day5_test.txt", 'r') or die("Unable to open file...");
    $grid = array();
    while (($line = fgets($input, 2024)) !== false) {
        $pointsStr = explode(" -> ", $line);
        $pointStart = $pointsStr[0];
        $pointEnd = $pointsStr[1];
        $x1 = intval(explode(",", $pointStart)[0]);
        $y1 = intval(explode(",", $pointStart)[1]);
        $x2 = intval(explode(",", $pointEnd)[0]);
        $y2 = intval(explode(",", $pointEnd)[1]);
        $grX = ($x1 > $x2) ? $x1 : $x2; // Greatest X
        $lowX = ($x1 > $x2) ? $x2 : $x1; // Lowest X
        $grY = ($y1 > $y2) ? $y1 : $y2; // Greatest Y
        $lowY = ($y1 > $y2) ? $y2 : $y1; // Lowest Y
        while ($lowX <= $grX) {
            echo "$lowX, $lowY<br />";
            while ($lowY <= $grY) {
                if ($lowY >= $grY) break;
                if (isset($grid[$lowX])) {
                    if (isset($grid[$lowX][$lowY]))
                        $grid[$lowX][$lowY] += 1;
                    else
                        $grid[$lowX][$lowY] = 1;
                } else {
                    $grid[$lowX][$lowY] = 1;
                }
                $lowY++;
            }
            $lowX++;
        }
        echo "<br /><br />";
    }
    $intersects = 0;
    foreach ($grid as $x => $yes) {
        foreach ($yes as $y => $count) {
            if ($count > 1)
                $intersects++;
        }
    }
    return $intersects;
}
function part2() {}
echo "<h1>Part 1</h1><pre>";
echo part1();
echo "</pre><h2>Part 2</h2><pre>";
echo part2();
echo "</pre>";