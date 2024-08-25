<?php
  namespace Scandiweb\WebDeveloper\Models;

interface Product {
    public function getSku();
    public function getName();
    public function getPrice();
    public function getCategorySpecificAttribute();
}

