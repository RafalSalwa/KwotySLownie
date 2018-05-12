<?php

namespace RafalSalwa\AmountInWords\Transformer;

class NumberToWordTransformer
{

    private $words = Array(
        'minus',

        Array(
            'zero',
            'jeden',
            'dwa',
            'trzy',
            'cztery',
            'pięć',
            'sześć',
            'siedem',
            'osiem',
            'dziewięć'),

        Array(
            'dziesięć',
            'jedenaście',
            'dwanaście',
            'trzynaście',
            'czternaście',
            'piętnaście',
            'szesnaście',
            'siedemnaście',
            'osiemnaście',
            'dziewiętnaście'),

        Array(
            'dziesięć',
            'dwadzieścia',
            'trzydzieści',
            'czterdzieści',
            'pięćdziesiąt',
            'sześćdziesiąt',
            'siedemdziesiąt',
            'osiemdziesiąt',
            'dziewięćdziesiąt'),

        Array(
            'sto',
            'dwieście',
            'trzysta',
            'czterysta',
            'pięćset',
            'sześćset',
            'siedemset',
            'osiemset',
            'dziewięćset'),

        Array(
            'tysiąc',
            'tysiące',
            'tysięcy'),

        Array(
            'milion',
            'miliony',
            'milionów'),

        Array(
            'miliard',
            'miliardy',
            'miliardów'),

        Array(
            'bilion',
            'biliony',
            'bilionów'),

        Array(
            'biliard',
            'biliardy',
            'biliardów'),

        Array(
            'trylion',
            'tryliony',
            'trylionów')
    );


    private function wordVariety($wordVarieties, $int)
    {
        $txt = $wordVarieties[2];
        if ($int == 1) $txt = $wordVarieties[0];
        $decimals = (int)substr($int, -1);
        $rest = $int % 100;
        if (($decimals > 1 && $decimals < 5) & !($rest > 10 && $rest < 20))
            $txt = $wordVarieties[1];
        return $txt;
    }

    private function wordNumberFormat($int)
    {
        $output = '';
        $j = abs((int)$int);

        if ($j == 0) return $this->words[1][0];
        $decimals = $j % 10;
        $dozens = ($j % 100 - $decimals) / 10;
        $hundreds = ($j - $dozens * 10 - $decimals) / 100;

        if ($hundreds > 0) $output .= $this->words[4][$hundreds - 1] . ' ';

        if ($dozens > 0)
            if ($dozens == 1) $output .= $this->words[2][$decimals] . ' ';
            else
                $output .= $this->words[3][$dozens - 1] . ' ';

        if ($decimals > 0 && $dozens != 1) $output .= $this->words[1][$decimals] . ' ';
        return $output;
    }

    private function toWord($int)
    {

        $in = preg_replace('/[^-\d]+/', '', $int);
        $out = '';

        if ($in{0} == '-') {
            $in = substr($in, 1);
            $out = $this->words[0] . ' ';
        }

        $txt = str_split(strrev($in), 3);

        if ($in == 0) $out = $this->words[1][0] . ' ';

        for ($i = count($txt) - 1; $i >= 0; $i--) {
            $number = (int)strrev($txt[$i]);

            if ($number > 0)
                if ($i == 0)
                    $out .= $this->wordNumberFormat($number) . ' ';
                else
                    $out .= ($number > 1 ? $this->wordNumberFormat($number) . ' ' : '')
                        . $this->wordVariety($this->words[4 + $i], $number) . ' ';
        }
        return trim($out);
    }

    public function transformToText($number)
    {
        $number = explode('.', $number);
        $zl = preg_replace('/[^-\d]+/', '', $number[0]);
        $gr = preg_replace('/[^\d]+/', '', substr(isset($number[1]) ? $number[1] : 0, 0, 2));
        while (strlen($gr) < 2) $gr .= '0';

        return $this->toWord($zl) . ' ' . $this->wordVariety(Array('złoty', 'złote', 'złotych'), $zl) .
            (intval($gr) == 0 ? '' :
                ' ' . $this->toWord($gr) . ' ' . $this->wordVariety(Array('grosz', 'grosze', 'groszy'), $gr));
    }
}