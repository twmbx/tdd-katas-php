<?php

namespace Tests;

use App\FizzBuzz;

class FizzBuzzTest extends TestCase
{
    public function fizzBuzzProvider()
    {
        return [
            'Test that 1 returns 1' => [1, '1'],
            'Test that 2 returns 2' => [2, '2'],
            'Test that 3 returns Fizz' => [3, 'Fizz'],
            'Test that 5 returns Buzz' => [5, 'Buzz'],
            'Test that 6 returns Fizz' => [6, 'Fizz'],
            'Test that 10 returns Buzz' => [10, 'Buzz'],
            'Test that 15 returns FizzBuzz' => [15, 'FizzBuzz'],
            'Test that 101 returns Invalid' => [101, 'Invalid'],
            'Test that -1 returns Invalid' => [-1, 'Invalid']
        ];
    }

    /**
     * @dataProvider fizzBuzzProvider
     */
    public function testInput(int $number, string $expected)
    {
        $fizzBuzz = new FizzBuzz();

        $result = $fizzBuzz->invoke($number);

        $this->assertSame($expected, $result);
    }
}
