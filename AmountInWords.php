<?php
namespace RafalSalwa\AmountInWords;

use RafalSalwa\AmountInWords\NumberParser;
use RafalSalwa\AmountInWords\Transformer\NumberToWordTransformer;
use RafalSalwa\AmountInWords\Collection\Number;

class AmountInWords
{

    private $numbers = [];

    public function amountInWords($numbers){

        $numberParser = new NumberParser();
        $numbersCollection = $numberParser->getNumbersCollectionFromData($numbers);
        $numberTransformer = new NumberToWordTransformer();
        foreach($numbersCollection->getNumbers() as $number){
            echo $numberTransformer->transformToText($number->getValue()) . PHP_EOL;
        }

    }

}
