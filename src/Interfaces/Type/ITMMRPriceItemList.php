<?php


namespace Interfaces\Type;


interface ITMMRPriceItemList
{
    public function __construct(ITMMRValue $mmr, ITMMRPriceValue $price);
    public function getMMR(): ITMMRValue;
    public function getPrice(): ITMMRPriceValue;
}