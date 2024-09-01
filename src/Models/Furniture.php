<?php
namespace Scandiweb\WebDeveloper\Models;

class Furniture implements Product
{
    private  $sku;
    private  $name;
    private  $price;
    private  $height;
    private  $width;
    private  $length;

    public function __construct( $sku,  $name,  $price,  $height,  $width,  $length)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
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
        return [
            'height' => $this->height,
            'width' => $this->width,
            'length' => $this->length
        ];
    }
}