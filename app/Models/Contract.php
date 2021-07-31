<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    public $guarded = [];

    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
