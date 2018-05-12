<?php

namespace RafalSalwa\AmountInWords\Collection;

class NumberCollection
{

    private $numbers = [];

    public function addNumber($number)
    {
        $this->numbers[] = new Number($number);
    }

    public function getNumbers()
    {
        return $this->numbers;
    }
}