<?php
function part1() {
    $input = fopen(__DIR__ . "/../inputs/day5.txt", 'r') or die("Unable to open file...");
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
        if ($x1 == $x2) {
            while ($lowY <= $grY) {
                if (isset($grid[$x1]))
                    if (isset($grid[$x1][$lowY]))
                        $grid[$x1][$lowY] += 1;
                    else
                        $grid[$x1][$lowY] = 1;
                else
                    $grid[$x1][$lowY] = 1;
                $lowY++;
            }
        }
        if ($y1 == $y2) {
            while ($lowX <= $grX) {
                if (isset($grid[$lowX]))
                    if (isset($grid[$lowX][$y1]))
                        $grid[$lowX][$y1] += 1;
                    else
                        $grid[$lowX][$y1] = 1;
                else
                    $grid[$lowX][$y1] = 1;
                $lowX++;
            }
        }
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
function part2() {
    $input = fopen(__DIR__ . "/../inputs/day5.txt", 'r') or die("Unable to open file...");
    $grid = array();
    while (($line = fgets($input, 2024)) !== false) {
        $str .= $line;
        $pointsStr = explode(" -> ", $line);
        $pointStart = $pointsStr[0];
        $pointEnd = $pointsStr[1];
        $x1 = intval(explode(",", $pointStart)[0]);
        $y1 = intval(explode(",", $pointStart)[1]);
        $x2 = intval(explode(",", $pointEnd)[0]);
        $y2 = intval(explode(",", $pointEnd)[1]);
        $x = $x1;
        $y = $y1;
        // Needs to incorporate vertical, horizontal, and diagonal lines now:
        $points = max(abs($x1 - $x2), abs($y1 - $y2));
        for ($i = 0; $i <= $points; $i++) {
            $grid[$x][$y] = ($grid[$x][$y] ?? 0) + 1;
            $x += $x2 <=> $x1;
            $y += $y2 <=> $y1;
        }
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

echo "<h1>Part 1</h1><pre>";
echo part1();
echo "</pre><h2>Part 2</h2><pre>";
echo part2();
echo "</pre>";