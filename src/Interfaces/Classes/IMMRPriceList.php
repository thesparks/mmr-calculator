<?php


namespace Interfaces\Classes;


use Interfaces\Type\ITMMRPriceItemList;
use Interfaces\Type\ITMMRPriceValue;
use Interfaces\Type\ITMMRValue;

interface IMMRPriceList extends \Iterator
{
    public function add(ITMMRValue $mmr, ITMMRPriceValue $price);
    public function current(): ITMMRPriceItemList;
}