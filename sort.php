<?php

$filename = 'php://stdin';
$file = fopen($filename, 'r');

if ($file) {
    $array = explode("\n", fread($file, 8192));
 }

for ($i = 0; $i < count($array) - 1; $i++) {
    for ($j = $i + 1; $j < count($array); $j++) {
        if(preg_match('/[\'^£$%&*()}{@#~?!><>,|=_+¬-]/', $array[$j])) {
            $temp = $array[$i];
            $array[$i] = $array[$j];
            $array[$j] = $temp;
        } elseif(!preg_match('/[\'^£$%&*()}{@#~?!><>,|=_+¬-]/', $array[$i]) && is_numeric($array[$j]) && $array[$j] < $array[$i]) {
            $temp = $array[$i];
            $array[$i] = $array[$j];
            $array[$j] = $temp;
        } elseif(!preg_match('/[\'^£$%&*()}{@#~?!><>,|=_+¬-]/', $array[$i]) && !is_numeric($array[$i]) && ord(strtoupper($array[$i])) > ord(strtoupper($array[$j]))) {
            $temp = $array[$i];
            $array[$i] = $array[$j];
            $array[$j] = $temp;
            if(ord(strtoupper($array[$i])) == ord(strtoupper($array[$i - 1]))) {
                if (ord($array[$i]) > ord($array[$i - 1])) {
                    $temp = $array[$i];
                    $array[$i] = $array[$i - 1];
                    $array[$i - 1] = $temp;
                }
            }

        }
    }
    for ($j = $i; $j > 0; $j--) { 
        if(ord($array[$j - 1]) == ord($array[$j])) {
            caseSameLetters($array[$j], $array[$j - 1], 0);
        }
    }
}

foreach ($array as $value) {
    echo $value . "\n";
}

function caseSameLetters(&$currStr, &$prevStr, $i) {
    if((ord(substr($prevStr, $i, 1)) >= 65 && ord(substr($prevStr, $i, 1)) <= 90)
    && (
        (ord(substr($currStr, $i, 1)) >= 65 && ord(substr($currStr, $i, 1)) <= 90 && ord(substr($currStr, $i, 1)) < ord(substr($prevStr, $i, 1)))
        || (ord(substr($currStr, $i, 1)) >= 97 && ord(substr($currStr, $i, 1)) <= 122)
        )
    ) {
        $temp = $currStr;
        $currStr = $prevStr;
        $prevStr = $temp;
    }
    if(ord(substr($prevStr, $i, 1)) >= 97 && ord(substr($prevStr, $i, 1)) <= 122 && ord(substr($currStr, $i, 1)) >= 97 && ord(substr($currStr, $i, 1)) <= 122 && ord(substr($currStr, $i, 1)) < ord(substr($prevStr, $i, 1))) {
        $temp = $currStr;
        $currStr = $prevStr;
        $prevStr = $temp;
    }
    if(substr($currStr, $i, 1) == "") {
        $temp = $currStr;
        $currStr = $prevStr;
        $prevStr = $temp;
    }
    if(ord(substr($currStr, $i, 1)) == ord(substr($prevStr, $i, 1)) && substr($prevStr, $i, 1) != "") {
        caseSameLetters($currStr, $prevStr, $i + 1);
    }
}