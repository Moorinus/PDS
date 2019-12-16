<?php
declare(strict_types=1);

$units = ['', 'jeden ', 'dwa ', 'trzy ', 'cztery ', 'pięć ', 'sześć ', 'siedem ', 'osiem ', 'dziewięć '];
$dozens = ['', 'dziesięć ', 'dwadzieścia ', 'trzydzieści ', 'czterdzieści ', 'pięćdziesiąt ', 'sześćdziesiąt ', 'siedemdziesiąt ', 'osiemdziesiąt ', 'dziewięćdziesiąt '];
$hundreds = ['', 'sto ', 'dwieście ', 'trzysta ', 'czterysta ', 'pięćset ', 'sześćset ', 'siedemset ', 'osiemset ', 'dziewięćset '];
$nastki = ['dziesięć', 'jedenaście ','dwanaście ','trzynaście ','czternaście ','pietnaście ','szesnaście ','siedemnaście ','osiemnaście ','dziewietnaście '];
$orderOfMagnitude = [
    ['grosz ', 'grosze ', 'groszy '],
    ['złoty ', 'złote ', 'złotych '],
    ['tysiąc ', 'tysiące ', 'tysięcy '],
    ['milion ', 'miliony ', 'milionów '],
    ['miliard ', 'miliardy ', 'miliardów '],
    ['bilion ', 'biliony ', 'biliponów '],
    ['biliard ', 'biliardy ', 'biliardów '],
    ['trylion ', 'tryliony ', 'trylionów ']  
];

$given = str_replace(',','.',$argv[1]);

if (!is_numeric($given)) {
    exit('Wprowadzony ciąg znaków nie jest liczbą');
} 

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

function numbersToWords($number) {
    global $hundreds;
    global $dozens;
    global $units;
    global $nastki;
    global $orderOfMagnitude;
    $numberTable = str_split($number);
 
    if (strlen($number) == 2 ) {
        $numberTable = str_split($number);
        if ($numberTable[0] == '1') {
        return $nastki[$numberTable[1]].$orderOfMagnitude[0][2];
        } elseif ($numberTable[1] < 5) {
        return $dozens[$numberTable[0]].$units[$numberTable[1]].$orderOfMagnitude[0][1];
        } elseif (($numberTable[1] > 4)) {
        return $dozens[$numberTable[0]].$units[$numberTable[1]].$orderOfMagnitude[0][2];
        }
    }
 
    if ($numberTable[1] == '1') {
    return $hundreds[$numberTable[0]].$nastki[$numberTable[2]];
    } elseif ($numberTable[0] < 5) {
    return $hundreds[$numberTable[0]].$dozens[$numberTable[1]].$units[$numberTable[2]];
    } else {
    return $hundreds[$numberTable[0]].$dozens[$numberTable[1]].$units[$numberTable[2]];
    }
}

$magnitudePosition = count($splitWholeNumber);
foreach ($splitWholeNumber as $numbers) {
    
    echo numbersToWords($numbers);
    $magnitudePosition--;
}
echo ' i '.numbersToWords($fractionNumber);
