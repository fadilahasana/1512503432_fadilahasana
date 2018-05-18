<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

//dila
    

    protected $fillable = [
        'title',
        'category_id',
        'author',
        'isbn',
        'publish',
    ];

    protected $guarded = [
        'id'
    ];
}