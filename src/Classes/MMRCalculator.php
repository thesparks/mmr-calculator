<?php


namespace Classes;


use Exception\MMRCalculatorException;
use Interfaces\Classes\IMMRPriceList;
use Interfaces\Type\ITMMRPriceItemList;
use Interfaces\Type\ITMMRValue;

/**
 * Class MMRCalculator
 * @package Classes
 */
class MMRCalculator
{
    /**
     * @var IMMRPriceList
     */
    private $priceList;

    /**
     * MMRCalculator constructor.
     * @param IMMRPriceList $priceList
     */
    public function __construct(IMMRPriceList $priceList)
    {
        $this->priceList = $priceList;
    }

    /**
     * @param ITMMRValue $startMMR
     * @param ITMMRValue $endMMR
     * @return int
     */
    public function calculate(ITMMRValue $startMMR, ITMMRValue $endMMR): int
    {
        if($startMMR() >= $endMMR()){
            throw new MMRCalculatorException('Error start or end mmr');
        }

        $result = $prevItemMMR = 0;

        foreach($this->priceList as $priceItem){

            $itemMMR = $priceItem->getMMR()();

            if($startMMR() <= $itemMMR){

                if($itemMMR > $endMMR()){

                    if($result){
                        $mmr = $endMMR() - $prevItemMMR;
                    } else {
                        $mmr = $endMMR() - $startMMR();
                    }

                    $result += $this->calculateMMRPrice($mmr, $priceItem);
                    break;

                } elseif($prevItemMMR <= $startMMR()){
                    $result += $this->calculateMMRPrice($itemMMR - $startMMR(), $priceItem);
                } else{
                    $result += $this->calculateMMRPrice($itemMMR - $prevItemMMR, $priceItem);
                }

            }

            $prevItemMMR = $priceItem->getMMR()();
        }

        return $result;
    }

    /**
     * @param $mmr
     * @param ITMMRPriceItemList $priceItem
     * @return float|int
     */
    private function calculateMMRPrice($mmr, ITMMRPriceItemList $priceItem): int
    {
        return $mmr * $priceItem->getPrice()();
    }
}