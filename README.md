# Amount In Words

Convert numbers into currency. 

I.E 123,45 to `` Sto dwadzieścia trzy złote, czterdzieści pięć groszy ``

1. Usage:

```
$wordAmount = new AmountInWords();
$amountInWords = $wordAmount->amountInWords(array("123.30", "111,10"));
```

1.a Result:

```
sto dwadzieścia trzy złote trzydzieści groszy
sto jedenaście złotych dziesięć groszy
```
