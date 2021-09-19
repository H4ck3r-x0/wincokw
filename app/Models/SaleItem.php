<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;
    public $guarded = [];

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'item_categories_id');
    }

    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
