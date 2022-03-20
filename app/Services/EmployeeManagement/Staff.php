<?php

namespace App\Services\EmployeeManagement;
use App\Services\EmployeeManagement\Contracts\PayableInterface;

class Staff implements PayableInterface
{    
    public function salary(): int
    {
        return 200;
    }
}