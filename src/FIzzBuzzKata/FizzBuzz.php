<?php

namespace App\FizzBuzzKata;

class FizzBuzz
{
    public function invoke(int $number): string
    {
        if (1 > $number || 101 <= $number) {
            return 'Invalid';
        }
        if (0 === $number % 3 && 0 === $number % 5) {
            return 'FizzBuzz';
        }
        if (0 === $number % 3 || false !== strpos((string) $number, '3')) {
            return 'Fizz';
        }
        if (0 === $number % 5 || false !== strpos((string) $number, '5')) {
            return 'Buzz';
        }
        return (string) $number;
    }
}
