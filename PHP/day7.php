<?php
function part1() {
    $input = fopen(__DIR__ . "/../inputs/day7.txt", 'r') or die("Unable to open file...");
    $positions = [];
    while (($line = fgets($input, 4024)) !== false) {
        $positions = array_map('intval', explode(",", $line));
    }
    $min = min($positions);
    $max = max($positions);
    $fuel = PHP_INT_MAX;
    for ($i = $min; $i <= $max; $i++) {
        $sum = 0;
        foreach ($positions as $position) {
            $sum += abs($position - $i);
        }
        $fuel = min($fuel, $sum);
    }
    return $fuel;
}
function part2() {
    $input = fopen(__DIR__ . "/../inputs/day7.txt", 'r') or die("Unable to open file...");
    $positions = [];
    while (($line = fgets($input, 4024)) !== false) {
        $positions = array_map('intval', explode(",", $line));
    }
    $min = min($positions);
    $max = max($positions);
    $fuel = PHP_INT_MAX;
    for ($i = $min; $i <= $max; $i++) {
        $sum = 0;
        foreach ($positions as $position) {
            $steps = abs($position - $i);
            $sum += $steps * ($steps + 1) / 2;
        }
        $fuel = min($fuel, $sum);
    }
    return $fuel;
}
echo "<h1>Part 1</h1><pre>";
echo part1();
echo "</pre><h2>Part 2</h2><pre>";
echo part2();
echo "</pre>";