<?php
 namespace Scandiweb\WebDeveloper\Models;

 class Book implements Product {
     private  $sku;
     private  $name;
     private  $price;
     private $weight;

     public function __construct( $sku,  $name,  $price,  $weight) {
         $this->sku = $sku;
         $this->name = $name;
         $this->price = $price;
         $this->weight = $weight;
     }

     public function getSku()  { return $this->sku; }
     public function getName()  { return $this->name; }
     public function getPrice()  { return $this->price; }
     public function getCategorySpecificAttribute() {
         return ['weight' => $this->weight];
     }

 }