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
        /** @var Number $number */
        foreach($numbersCollection->getNumbers() as $number){
            $number->setTextValue($numberTransformer->transformToText($number->getValue()));
        }
        return $numbersCollection;
    }

}
