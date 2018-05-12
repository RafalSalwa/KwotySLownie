<?php
/**
 * Created by PhpStorm.
 * User: rafal
 * Date: 12.05.18
 * Time: 20:47
 */

namespace RafalSalwa\AmountInWords\Collection;


class Number
{
    private $value = 0;
    private $isValid = false;
    private $textValue = '';

    public function __construct($number)
    {
        $this->setValue($number['value']);
        $this->setIsValid($number['isValid']);
    }

    public function getValue()
    {
        return $this->value;

    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * @param bool $isValid
     */
    public function setIsValid(bool $isValid)
    {
        $this->isValid = $isValid;
    }

    /**
     * @return string
     */
    public function getTextValue(): string
    {
        return $this->textValue;
    }

    /**
     * @param string $textValue
     */
    public function setTextValue(string $textValue)
    {
        $this->textValue = $textValue;
    }


}