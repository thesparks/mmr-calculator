<?php


namespace Interfaces\Type;


interface ITMMRPriceValue
{
    public function __construct(int $price);
    public function __invoke(): int;
}