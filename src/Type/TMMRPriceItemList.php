<?php


namespace Type;


use Interfaces\Type\ITMMRPriceItemList;
use Interfaces\Type\ITMMRPriceValue;
use Interfaces\Type\ITMMRValue;

class TMMRPriceItemList implements ITMMRPriceItemList
{
    /**
     * @var ITMMRValue
     */
    private $mmr;

    /**
     * @var ITMMRPriceValue
     */
    private $price;

    /**
     * TMMRPriceItemList constructor.
     * @param ITMMRValue $mmr
     * @param ITMMRPriceValue $price
     */
    public function __construct(ITMMRValue $mmr, ITMMRPriceValue $price)
    {
        $this->mmr = $mmr;
        $this->price = $price;
    }

    /**
     * @return ITMMRValue
     */
    public function getMMR(): ITMMRValue
    {
        return $this->mmr;
    }

    /**
     * @return ITMMRPriceValue
     */
    public function getPrice(): ITMMRPriceValue
    {
        return $this->price;
    }
}