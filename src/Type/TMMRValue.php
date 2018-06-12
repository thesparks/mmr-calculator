<?php


namespace Type;


use Exception\TMMRException;
use Interfaces\Type\ITMMRValue;

class TMMRValue implements ITMMRValue
{
    /**
     * @var int
     */
    private $mmr;

    private CONST MIN_MMR = 0;
    private CONST MAX_MMR = 7000;

    /**
     * TMMRValue constructor.
     * @param int $mmr
     * @throws TMMRException
     */
    public function __construct(int $mmr)
    {
        if($mmr < self::MIN_MMR || $mmr > self::MAX_MMR){
            throw new TMMRException('Range error');
        }

        $this->mmr = $mmr;
    }

    /**
     * @return int
     */
    public function __invoke(): int
    {
        return $this->mmr;
    }
}