<?php
function part1() {
    $input = fopen(__DIR__ . "/../inputs/day7_test.txt", 'r') or die("Unable to open file...");
    $positions = [];
    while (($line = fgets($input, 2024)) !== false) {
        $positions = explode(",", $line);
    }

}
function part2() {
    $input = fopen(__DIR__ . "/../inputs/day7.txt", 'r') or die("Unable to open file...");
    while (($line = fgets($input, 2024)) !== false) {
        //
    }
}
echo "<h1>Part 1</h1><pre>";
echo part1();
echo "</pre><h2>Part 2</h2><pre>";
echo part2();
echo "</pre>";