<?php
/** /
 * Author: Jared Scarito
 * Created: 12/3/2021 12:47 PM
 * /**/
function part1() {
    $input = fopen(__DIR__ . "/../inputs/day1.txt", 'r') or die("Unable to open file...");
    $previousLine = null;
    $increaseCount = 0;
    while (($line = fgets($input, 2024)) !== false) {
        if ($previousLine != null)
            if (intval($previousLine) < intval($line))
                $increaseCount++;
        $previousLine = $line;
    }
    fclose($input);
    echo "$increaseCount";
}
function part2() {
    $input = file_get_contents(__DIR__ . "/inputs/day1.txt", 'r') or die("Unable to open file...");
    $panes = [];
    $lines = explode("\n", $input);
    for ($i = 0; $i < (sizeof($lines) - 2); $i++) {
        $measure1 = $lines[$i];
        $measure2 = $lines[$i + 1];
        $measure3 = $lines[$i + 2];
        $sum = $measure1 + $measure2 + $measure3;
        $panes[$i] = $sum;
    }
    $increaseCount = 0;
    for ($i = 0; $i < (sizeof($panes) - 1); $i++) {
        if ($panes[$i + 1] > $panes[$i])
            $increaseCount++;
    }
    echo "$increaseCount";
}