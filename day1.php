<?php
/** /
 * Author: Jared Scarito
 * Created: 12/3/2021 12:47 PM
 * /**/
$input = fopen(__DIR__ . "/inputs/day1.txt", 'r') or die("Unable to open file...");
$previousLine = null;
$increaseCount = 0;
while ( ($line = fgets($input, 2024)) !== false) {
    if ($previousLine != null)
        if (intval($previousLine) < intval($line))
            $increaseCount++;
    $previousLine = $line;
}
fclose($input);
echo "$increaseCount";