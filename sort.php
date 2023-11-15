<?php

$filename = 'php://stdin';
getopt("", [], $restIndex);
if(isset($argv[$restIndex])) {
    $filename = $argv[$restIndex];
} 
$array = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$arrayLength = count($array);
for ($i = 0; $i < $arrayLength; $i++) {
    for ($j = $arrayLength - 1; $j > $i; $j--) {
        if(compareAscii($array[$j], $array[$j - 1])) swapElem($array[$j], $array[$j - 1]);
    }
}

foreach ($array as $value) {
    echo $value . "\n";
}

function swapElem(&$currStr, &$prevStr) {
    $temp = $currStr;
    $currStr = $prevStr;
    $prevStr = $temp;
}

function compareAscii($currStr, $prevStr, $i = 0) {
    $currStrChar = substr($currStr, $i, 1);
    $prevStrChar = substr($prevStr, $i, 1);
    if (ord($currStrChar) < ord($prevStrChar)) return true;
    if (ord($currStrChar) > ord($prevStrChar)) return false;

    if ($currStrChar == null && $prevStrChar == null) return false;
    return compareAscii($currStr, $prevStr, $i + 1);
}
