<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    Protected $guarded= [];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($Category) {
            $Category->slug = Str::slug($Category->name);
        });
    }

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
