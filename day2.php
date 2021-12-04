<?php
/** /
 * Author: Jared Scarito
 * Created: 12/3/2021 4:20 PM
 * /**/
function part1() {
    $input = fopen(__DIR__ . "/inputs/day2.txt", 'r') or die("Unable to open file...");
    $data = ['horizontal' => 0, 'depth' => 0];
    while (($line = fgets($input, 2024)) !== false) {
        $exp = explode(" ", $line);
        switch ($exp[0]) {
            case "up":
                $data['depth'] -= intval($exp[1]);
                break;
            case "down":
                $data['depth'] += intval($exp[1]);
                break;
            case "forward":
                $data['horizontal'] += intval($exp[1]);
                break;
        }
    }
    echo $data['horizontal'] * $data['depth'];
}
function part2() {
    $input = fopen(__DIR__ . "/inputs/day2.txt", 'r') or die("Unable to open file...");
    $data = ['horizontal' => 0, 'depth' => 0, 'aim' => 0];
    while (($line = fgets($input, 2024)) !== false) {
        $exp = explode(" ", $line);
        switch ($exp[0]) {
            case "up":
                $data['aim'] -= intval($exp[1]);
                break;
            case "down":
                $data['aim'] += intval($exp[1]);
                break;
            case "forward":
                $data['horizontal'] += intval($exp[1]);
                $data['depth'] += ($data['aim'] * intval($exp[1]));
                break;
        }
    }
    echo $data['horizontal'] * $data['depth'];
}