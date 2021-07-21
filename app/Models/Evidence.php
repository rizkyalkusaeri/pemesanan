<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    use HasFactory;

    protected $table = 'evidence';

    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}