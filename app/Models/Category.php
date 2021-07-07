<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;

    Protected $guarded= [];

    public function parent_category(){
        return $this->belongsTo(Category::class);
    }

    public function child_category(){
        return $this->hasMany(Category::class);
    }

    public function Product(){
        return $this->hasMany(Product::class);
    }
}
