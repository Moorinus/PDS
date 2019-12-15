<?php
declare(strict_types=1);

$units = ['', 'jeden ', 'dwa ', 'trzy ', 'cztery ', 'pięć ', 'sześć ', 'siedem ', 'osiem ', 'dziewięć '];
$dozens = ['', 'dziesięć ', 'dwadzieścia ', 'trzydzieści ', 'czterdzieści ', 'pięćdziesiąt ', 'sześćdziesiąt ', 'siedemdziesiąt ', 'osiemdziesiąt ', 'dziewięćdziesiąt '];
$hundreds = ['', 'sto ', 'dwieście ', 'trzysta ', 'czterysta ', 'pięćset ', 'sześćset ', 'siedemset ', 'osiemset ', 'dziewięćset '];

$given = str_replace(',','.',$argv[1]);
if (strpos($given,'.')) {
    $separatedNumbers = explode('.',$given);
    $wholeNumber = $separatedNumbers[0];
    $wholeNumber = str_pad($wholeNumber, strlen($wholeNumber) + (3-(strlen($wholeNumber)%3)), "0", STR_PAD_LEFT);
    $splitWholeNumber = str_split($wholeNumber,3);
    $fractionNumber = $separatedNumbers[1]; 
} else {
    $splitWholeNumber = [$argv[1]];
    $fractionNumber = 00;
}

if (!is_numeric($given)) {
    echo 'Wprowadzony ciąg nie jest liczbą';
} elseif (count(str_split(strval($separatedNumbers[1]))) > 2) {
    echo 'Wprowadzono więcej niż 2 miejsca po przecinku';
} 

var_dump ( $splitWholeNumber );
foreach ($splitWholeNumber as $numbers) {
    echo numbersToWords($numbers);
}

function numbersToWords($number) {
   global $hundreds;
   global $dozens;
   global $units;
   $numberTable = str_split(strval($number));
   return $hundreds[$numberTable[0]].$dozens[$numberTable[1]].$units[$numberTable[2]];
}