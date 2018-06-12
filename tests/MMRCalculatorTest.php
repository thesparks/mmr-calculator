<?php

use PHPUnit\Framework\TestCase;
use Classes\MMRCalculator;
use Classes\MMRPriceList;
use Type\TMMRValue;
use Type\TMMRPriceValue;

class MMRCalculatorTest extends TestCase
{
    /**
     * @var MMRCalculator
     */
    private $calculator;

    protected function setUp()
    {
        $list = new MMRPriceList();

        $list->add(
            new TMMRValue(2500),
            new TMMRPriceValue(1)
        );

        $list->add(
            new TMMRValue(3500),
            new TMMRPriceValue(3)
        );

        $list->add(
            new TMMRValue(5500),
            new TMMRPriceValue(5)
        );

        $list->add(
            new TMMRValue(7000),
            new TMMRPriceValue(10)
        );

        $this->calculator = new MMRCalculator($list);
    }

    protected function tearDown()
    {
        $this->calculator = null;
    }

    public function addDataProvider()
    {
        return [
            [1500, 4200, 7500],

            [800, 801, 1],
            [0, 1500, 1500],

            [2499, 2500, 1],
            [2500, 2501, 3],
            [2500, 3000, 1500],

            [0, 7000, 30500],
        ];
    }

    /**
     * @dataProvider addDataProvider
     */
    public function testCalculate($startMMR, $endMMR, $expected)
    {
        $result = $this->calculator->calculate(
            new TMMRValue($startMMR),
            new TMMRValue($endMMR)
        );

        $this->assertEquals($expected, $result);
    }
}
