<?php

namespace App\Repositories;

use App\Models\DiscountCode;

class DiscountCodeRepository
{
    public function create($data)
    {
        DiscountCode::create($data);
    }
}