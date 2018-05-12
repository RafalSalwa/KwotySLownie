<?php

namespace RafalSalwa\AmountInWords;

use RafalSalwa\AmountInWords\Collection\NumberCollection;

class NumberParser
{
    private $numbers = [];

    public function getNumbersCollectionFromData($numbers)
    {
        $data = $this->prepareData($numbers);

        $numberValidator = new NumberValidator();
        $numberCollection = new NumberCollection();

        foreach ($data as $number) {
            $number =
                [
                    'value' => $number,
                    'isValid' => $numberValidator->isValid($number)
                ];
            $numberCollection->addNumber($number);
        }
        return $numberCollection;
    }

    private function prepareData($numbers)
    {
        if(is_array($numbers)){
            $numbers = implode(' ', $numbers);
        }

        if (is_numeric($numbers)) {
            array_map('intval', $numbers);
        } elseif (is_string($numbers)) {
            $numbers = str_replace(' ', PHP_EOL, $numbers);
            if(strpos($numbers, ',') !== false){
                $numbers = str_replace(',','.', $numbers);
            }
            $numbers = explode(PHP_EOL, $numbers);
        }
        return array_map('trim', $numbers);
    }
}