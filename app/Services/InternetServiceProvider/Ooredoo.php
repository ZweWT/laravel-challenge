<?php

namespace App\Services\InternetServiceProvider;

class Ooredoo extends Mpt
{
    public function __construct(){
        $this->operator = 'ooredoo';
        
        $this->monthlyFees = 150;
    }
}