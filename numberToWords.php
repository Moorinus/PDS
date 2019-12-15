<?php
declare(strict_types=1);

$units = ['', 'jeden ', 'dwa ', 'trzy ', 'cztery ', 'pięć ', 'sześć ', 'siedem ', 'osiem ', 'dziewięć '];
$dozens = ['', 'dziesięć ', 'dwadzieścia ', 'trzydzieści ', 'czterdzieści ', 'pięćdziesiąt ', 'sześćdziesiąt ', 'siedemdziesiąt ', 'osiemdziesiąt ', 'dziewięćdziesiąt '];
$hundreds = ['', 'sto ', 'dwieście ', 'trzysta ', 'czterysta ', 'pięćset ', 'sześćset ', 'siedemset ', 'osiemset ', 'dziewięćset '];
$nastki = ['dziesięć', 'jedenaście ','dwanaście ','trzynaście ','czternaście ','pietnaście ','szesnaście ','siedemnaście ','osiemnaście ','dziewietnaście '];

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
    exit('Wprowadzony ciąg znaków nie jest liczbą');
} 

foreach ($splitWholeNumber as $numbers) {
    echo numbersToWords($numbers);
}
echo ' i '.numbersToWords($fractionNumber);

function numbersToWords($number) {
   global $hundreds;
   global $dozens;
   global $units;
   global $nastki;
   $numberTable = str_split(strval($number));

    if (strlen($number) == 2 ) {
        $numberTable = str_split(strval($number));
        return $dozens[$numberTable[0]].$units[$numberTable[1]];
    }

    if ($numberTable[1] == '1') {
        return $hundreds[$numberTable[0]].$nastki[$numberTable[2]];
        } else {
        return $hundreds[$numberTable[0]].$dozens[$numberTable[1]].$units[$numberTable[2]];
    }
}
