<?php


namespace Interfaces\Type;


interface ITMMRValue
{
    public function __construct(int $mmr);
    public function __invoke(): int;
}