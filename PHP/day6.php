<?php
function part1() {
    $input = fopen(__DIR__ . "/../inputs/day6_test.txt", 'r') or die("Unable to open file...");
    $counter = [];
    $days = 80;
    $fishies = [];
    while (($line = fgets($input, 2024)) !== false) {
        $fishies = explode(",", $line);
    }
    $count = 0;
    $addFishies = [];
    $curr_day = 1;
    $counter = $fishies;
    while ($curr_day <= $days) {
        foreach ($counter as $fishIndex => $fishCounter) {
            if ($fishCounter > 0) {
                $counter[$fishIndex] = $fishCounter - 1;
            } else {
                $counter[$fishIndex] = 6;
                $addFishies[sizeof($counter) + sizeof($addFishies)] = 8;
            }
            $count += 1;
        }
        $counter = array_merge($counter, $addFishies);
        $addFishies = [];
        //echo "After $curr_day day(s): " . join(", ", $counter) . "<br />";
        $curr_day++;
    }
    return sizeof(array_keys($counter));
}
function part2() {
    $input = fopen(__DIR__ . "/../inputs/day6.txt", 'r') or die("Unable to open file...");
    $fishCounter = [];
    $days = 256;
    $fishies = [];
    while (($line = fgets($input, 2024)) !== false) {
        $fishies = explode(",", $line);
    }
    // Optimization time lol
    $curr_day = 0;
    $fishCounter = array_fill_keys(range(0, 8), 0);
    foreach ($fishies as $fish) {
        $fishu = intval($fish);
        isset($fishCounter[$fishu]) ? $fishCounter[$fishu] += 1 : $fishCounter[$fishu] = 1;
    }
    while ($curr_day < $days) {
        foreach ($fishCounter as $fish => $count) {
            if ($fish === 0) {
                $fishCounter[8] += $count;
                $fishCounter[6] += $count;
                $fishCounter[0] -= $count;
            } else {
                $fishCounter[($fish - 1)] += $count;
                $fishCounter[$fish] -= $count;
            }
        }
        //echo "After $curr_day day(s): <pre>" . json_encode($fishCounter, JSON_PRETTY_PRINT) . "</pre><br />";
        $curr_day++;
    }
    return array_sum($fishCounter);
}
echo "<h1>Part 1</h1><pre>";
echo part1();
echo "</pre><h2>Part 2</h2><pre>";
echo part2();
echo "</pre>";