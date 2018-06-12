<?php


namespace Type;


use Exception\TMMRPriceValueException;
use Interfaces\Type\ITMMRPriceValue;

class TMMRPriceValue implements ITMMRPriceValue
{
    /**
     * @var int
     */
    private $price;

    private CONST MIN_PRICE = 1;
    private CONST MAX_PRICE = 10;

    /**
     * TMMRValue constructor.
     * @param int $price
     * @throws TMMRPriceValueException
     */
    public function __construct(int $price)
    {
        if($price < self::MIN_PRICE || $price > self::MAX_PRICE){
            throw new TMMRPriceValueException('Range error');
        }

        $this->price = $price;
    }

    /**
     * @return int
     */
    public function __invoke(): int
    {
        return $this->price;
    }
}