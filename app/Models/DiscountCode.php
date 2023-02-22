<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    protected $fillable = ['code', 'campaign_id', 'discount_rate', 'expire_date'];

    use HasFactory;

    public function campaign() {
        return $this->belongsTo(Campaign::class);
    }
}
