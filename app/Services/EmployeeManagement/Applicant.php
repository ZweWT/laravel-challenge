<?php

namespace App\Services\EmployeeManagement;

use App\Services\EmployeeManagement\Contracts\ApplicableInterface;

class Applicant implements ApplicableInterface
{
    public function applyJob(): bool
    {
        return true;
    }
}