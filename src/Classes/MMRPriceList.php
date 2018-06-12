<?php


namespace Classes;


use Exception\MMRListValueException;
use Interfaces\Classes\IMMRPriceList;
use Interfaces\Type\ITMMRPriceItemList;
use Interfaces\Type\ITMMRPriceValue;
use Interfaces\Type\ITMMRValue;
use Type\TMMRPriceItemList;

/**
 * Class MMRPriceList
 * @package Classes
 */
class MMRPriceList implements IMMRPriceList
{
    /**
     * @var array
     */
    private $priceList;

    /**
     * @var bool
     */
    private $sort = true;


    /**
     * MMRPriceList constructor.
     */
    public function __construct()
    {
        $this->priceList = [];
    }

    /**
     * @param ITMMRValue $mmr
     * @param ITMMRPriceValue $price
     */
    public function add(ITMMRValue $mmr, ITMMRPriceValue $price): void
    {
        $this->sort = false;

        foreach($this->priceList as $priceItem){
            if($mmr() === $priceItem->getMMR()()){
                throw new MMRListValueException('Duplicate mmr');
            }
        }

        $this->priceList[] = new TMMRPriceItemList($mmr, $price);
    }

    /**
     * @return ITMMRPriceItemList
     */
    public function current(): ITMMRPriceItemList
    {
        return current($this->priceList);
    }

    public function next()
    {
        next($this->priceList);
    }

    public function key()
    {
        return key($this->priceList);
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return key($this->priceList) !== null;
    }

    public function rewind()
    {
        if(!$this->sort){

            usort($this->priceList, function(ITMMRPriceItemList $priceItem1, ITMMRPriceItemList $priceItem2){
                return $priceItem1->getMMR()() <=> $priceItem2->getMMR()();
            });

            $this->sort = true;
        }

        reset($this->priceList);
    }
}