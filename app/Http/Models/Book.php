<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

//dila


    protected $fillable = [
        'category_id',
        'title',
        'author',
        'isbn',
        'publish',
    ];

    protected $guarded = ['id'];

    public function book(){
    	return $this->belongsTo('App\Http\Models\Category','category_id');
    	}
}