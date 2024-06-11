<?php

namespace app\controllers\Calculator;

class PriceAdapter implements GetObjects
{
    private Price $price;
    private float $volume;
    private float $weight;
    private string $from;
    private string $to;
    private array $list;

    /**
     * @param Price $price
     * @param float $volume
     * @param float $weight
     * @param string $from
     * @param string $to
     */
    public function __construct(array $paramPrice, Price $price = new Price())
    {
        $this->price = $price;
        $this->volume = $paramPrice["volume"];
        $this->weight = $paramPrice["weight"];
        $this->from = $paramPrice["from"];
        $this->to = $paramPrice["to"];
    }

    public function getObjectsFromApi(): GetObjects
    {
        $this->list = $this->price->getPrice([
            "volume" => $this->volume,
            "weight" => $this->weight,
            "from" => $this->from,
            "to" => $this->to
        ]);
        return $this;
    }

    public function toArray() : array
    {
        return $this->list;
    }

}