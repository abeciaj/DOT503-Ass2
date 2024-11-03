<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\Calculator;
use InvalidArgumentException;

class CalculatorTest extends TestCase
{
    public function test_addition()
    {
        $calculator = new Calculator();

        $result = $calculator->add(2, 3);

        $this->assertEquals(5, $result);
    }

    public function test_subtraction()
    {
        $calculator = new Calculator();

        $result = $calculator->subtract(5, 3);

        $this->assertEquals(2, $result);
    }

    public function test_multiplication()
    {
        $calculator = new Calculator();

        $result = $calculator->multiply(4, 3);

        $this->assertEquals(12, $result);
    }

    public function test_division()
    {
        $calculator = new Calculator();

        $result = $calculator->divide(10, 2);

        $this->assertEquals(5, $result);
    }

    public function test_division_by_zero()
    {
        $this->expectException(InvalidArgumentException::class);

        $calculator = new Calculator();
        
        $calculator->divide(10, 0);
    }
}

