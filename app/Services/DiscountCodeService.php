<?php

namespace App\Services;

use App\Repositories\DiscountCodeRepository;
use Illuminate\Support\Facades\Storage;

class DiscountCodeService
{
    private $repository;

    public function __construct(DiscountCodeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function import($data)
    {
        try {
            $this->repository->create($data);
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
        }
    }
}