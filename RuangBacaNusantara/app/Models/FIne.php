<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FIne extends Model
{
    /** @use HasFactory<\Database\Factories\FIneFactory> */
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'amount',
        'paid'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
