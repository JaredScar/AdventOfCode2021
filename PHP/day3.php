<?php
function part1() {
    $input = fopen(__DIR__ . "/../inputs/day3.txt", 'r') or die("Unable to open file...");
    $bits = [];
    while (($line = fgets($input, 2024)) !== false) {
        $bitArr = str_split($line);
        for ($i = 0; $i < sizeof($bitArr); $i++) {
            $bit = $bitArr[$i];
            $bits[$i][] = $bit;
        }
    }
    $gammaRate = '';
    $epsRate = '';
    for ($i = 0; $i < sizeof($bits); $i++) {
        $counts = ['0' => 0, '1' => 0];
        for ($j = 0; $j < sizeof($bits[$i]); $j++) {
            $counts[strval($bits[$i][$j])] += 1;
        }
        if ($counts['1'] > $counts['0']) {
            $gammaRate .= '1';
            $epsRate .= '0';
        }
        if ($counts['0'] > $counts['1']) {
            $gammaRate .= '0';
            $epsRate .= '1';
        }
    }
    echo bindec($gammaRate) * bindec($epsRate);
}
function part2() {
    $input = fopen(__DIR__ . "/../inputs/day3.txt", 'r') or die("Unable to open file...");
    $binaryNumbers = [];
    while (($line = fgets($input, 2024)) !== false) {
        $binaryNumbers[] = $line;
    }
    function getBits($binaryNumbers) {
        $bits = [];
        foreach ($binaryNumbers as $binaryNumber) {
            foreach (str_split($binaryNumber) as $index => $char) {
                $bits[$index][$char] = ($bits[$index][$char] ?? 0) + 1;
            }
        }
        return $bits;
    }
    function reduce($binaryNumbers, $highBit, $lowBit) {
        $bitIndex = 0;
        while (count($binaryNumbers) > 1) {
            $bit = getBits($binaryNumbers)[$bitIndex];

            $binaryNumbers = array_filter($binaryNumbers, fn ($i) => $i[$bitIndex] === ($bit[1] >= $bit[0] ? $highBit : $lowBit));
            $bitIndex++;
        }
        return current($binaryNumbers);
    }
    $oxyRating = reduce($binaryNumbers, '1', '0');
    $co2 = reduce($binaryNumbers, '0', '1');
    echo bindec($oxyRating) * bindec($co2);
}
echo "<h1>Part 1</h1><pre>";
part1();
echo "</pre><h1>Part 2</h1><pre>";
part2();
echo "</pre>";