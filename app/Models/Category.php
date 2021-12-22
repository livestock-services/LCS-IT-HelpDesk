<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table= "query_categories";

    protected $fillable = [
        'categoryName'
    ];

    public function subcategories(){
        return $this->hasMany('App\Models\SubCategory', 'categoryId');
    }
}
