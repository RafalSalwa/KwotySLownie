<?php
namespace RafalSalwa\AmountInWords;

class NumberValidator
{

    public function isValid($value)
    {
        $value = filter_var($value, FILTER_SANITIZE_STRING);
        $tmpstring =preg_replace('/([0-9,]+(\.|\,[0-9]{2})?|(zł|zl))/', '', $value);
        $tmpstring = str_replace(' ', '', $tmpstring);
        if (strlen($tmpstring)) {
            return false;
        }
        return true;

    }
}