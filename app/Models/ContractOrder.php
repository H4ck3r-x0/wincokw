<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractOrder extends Model
{
    use HasFactory;
    public $guarded = [];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
