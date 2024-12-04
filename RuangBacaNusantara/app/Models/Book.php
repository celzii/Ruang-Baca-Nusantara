<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Book extends Model
{
    use CrudTrait;
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'ISBN',
        'publisher',
        'language',
        'year_of_publication',
        'category',
        'quantity',
        'image'
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
