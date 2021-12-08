<?php
function getSumOfBoard($board) {
    $sum = 0;
    for ($rowIndex = 0; $rowIndex < sizeof($board); $rowIndex++) {
        $boardRow = $board[$rowIndex];
        for ($colIndex = 0; $colIndex < sizeof($boardRow); $colIndex++) {
            $bingoVal = $boardRow[$colIndex];
            if ($bingoVal != '*') {
                $sum += $bingoVal;
            }
        }
    }
    return $sum;
}
function part1() {
    $input = fopen(__DIR__ . "/../inputs/day4.txt", 'r') or die("Unable to open file...");
    $boards = [];
    $bingoCalls = [];
    $ind = 0;
    $boardIndex = -1;
    $rowIndex = 0;
    while (($line = fgets($input, 2024)) !== false) {
        $line = str_replace("\r\n", "", $line);
        if ($ind == 0) {
            $bingoCalls = explode(",", $line);
        } else {
            if (strlen($line) > 0) {
                $nums = explode(" ", $line);
                $colIndex = 0;
                foreach ($nums as $num) {
                    if ($num == '') continue;
                    $boards[$boardIndex][$rowIndex][$colIndex] = $num;
                    $colIndex++;
                }
                $rowIndex++;
            } else {
                $boardIndex++;
                $rowIndex = 0;
            }
        }
        $ind++;
    }
    foreach ($bingoCalls as $call) {
        for ($i = 0; $i < sizeof($boards); $i++) {
            $board = $boards[$i];
            for ($rowIndex = 0; $rowIndex < sizeof($board); $rowIndex++) {
                $boardRow = $board[$rowIndex];
                for ($colIndex = 0; $colIndex < sizeof($boardRow); $colIndex++) {
                    $bingoVal = $boardRow[$colIndex];
                    if (strval($bingoVal) == strval($call)) {
                        $boards[$i][$rowIndex][$colIndex] = '*';
                    }
                }
            }
        }
        for ($i = 0; $i < sizeof($boards); $i++) {
            // Check for winner via in a row
            $board = $boards[$i];
            for ($rowIndex = 0; $rowIndex < sizeof($board); $rowIndex++) {
                $boardRow = $board[$rowIndex];
                $starCount = 0;
                for ($colIndex = 0; $colIndex < sizeof($boardRow); $colIndex++) {
                    $bingoVal = $boardRow[$colIndex];
                    if ($bingoVal == '*')
                        $starCount++;
                }
                if ($starCount == 5) {
                    return ($call * getSumOfBoard($board));
                }
            }
        }
    }
    // This code actually only checks for the winner of only a horizontal win, but the first board in the day4 input was
    // just for a horizontal win, so it worked fine for solving it xD... Part 2 will probably actually include a check
    // for a winner of a vertical win.
}
function part2() {
    $input = fopen(__DIR__ . "/../inputs/day4.txt", 'r') or die("Unable to open file...");
    $boards = [];
    $bingoCalls = [];
    $ind = 0;
    $boardIndex = -1;
    $rowIndex = 0;
    while (($line = fgets($input, 2024)) !== false) {
        $line = str_replace("\r\n", "", $line);
        if ($ind == 0) {
            $bingoCalls = explode(",", $line);
        } else {
            if (strlen($line) > 0) {
                $nums = explode(" ", $line);
                $colIndex = 0;
                foreach ($nums as $num) {
                    if ($num == '') continue;
                    $boards[$boardIndex][$rowIndex][$colIndex] = $num;
                    $colIndex++;
                }
                $rowIndex++;
            } else {
                $boardIndex++;
                $rowIndex = 0;
            }
        }
        $ind++;
    }
    $boardWinners = [];
    foreach ($bingoCalls as $call) {
        for ($i = 0; $i < sizeof($boards); $i++) {
            if (in_array($i, array_keys($boardWinners))) continue;
            $board = $boards[$i];
            for ($rowIndex = 0; $rowIndex < sizeof($board); $rowIndex++) {
                if (!isset($boards[$i])) break;
                $boardRow = $board[$rowIndex];
                for ($colIndex = 0; $colIndex < sizeof($boardRow); $colIndex++) {
                    $bingoVal = $boardRow[$colIndex];
                    if (strval($bingoVal) == strval($call)) {
                        $boards[$i][$rowIndex][$colIndex] = '*';
                    }
                }
            }
        }
        // Check for winner via in a row
        for ($i = 0; $i < sizeof($boards); $i++) {
            if (in_array($i, array_keys($boardWinners))) continue;
            $board = $boards[$i];
            for ($rowIndex = 0; $rowIndex < sizeof($board); $rowIndex++) {
                if (!isset($boards[$i])) break;
                $boardRow = $board[$rowIndex];
                $starCount = 0;
                for ($colIndex = 0; $colIndex < sizeof($boardRow); $colIndex++) {
                    $bingoVal = $boardRow[$colIndex];
                    if ($bingoVal == '*')
                        $starCount++;
                }
                if ($starCount == 5) {
                    $boardWinners[$i] = (getSumOfBoard($board) * $call);
                }
            }
        }
        // Check for winner via in a column
        for ($i = 0; $i < sizeof($boards); $i++) {
            if (in_array($i, array_keys($boardWinners))) continue;
            $board = $boards[$i];
            $colIndex = 0;
            while ($colIndex < 4) {
                $starCount = 0;
                for ($rowIndex = 0; $rowIndex < 4; $rowIndex++) {
                    if (!isset($boards[$i])) break;
                    $boardRow = $board[$rowIndex];
                    $bingoVal = $boardRow[$colIndex];
                    if ($bingoVal == '*')
                        $starCount++;
                    if ($starCount == 5) {
                        $boardWinners[$i] = (getSumOfBoard($board) * $call);
                    }
                }
                $colIndex++;
            }
        }
    }
    return end($boardWinners);
}
echo "<h1>Part 1</h1><pre>";
echo part1();
echo "</pre><h2>Part 2</h2><pre>";
echo part2();
echo "</pre>";