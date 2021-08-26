<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ContractOrder extends Model
{
    use HasFactory, LogsActivity;
    public $guarded = [];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
