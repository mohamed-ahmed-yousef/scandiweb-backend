<?php

namespace Scandiweb\WebDeveloper\Models;

class DVD implements Product
{
    protected $sku;
    protected $name;
    protected $price;
    protected $size;

    public function __construct($sku, $name, $price, $size)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->size = $size;
    }

    public function getSku()
    {
        return $this->sku;
    }
    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getCategorySpecificAttribute()
    {
        return ['size' => $this->size];
    }

}