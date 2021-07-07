<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Category;
use App\Models\OrderProduct;
use Illuminate\Support\Str;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded=[];

     /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($product) {
            $product->slug= Str::slug($product->title);
        });
    }

    public function Category(){
        return $this->hasOne(Category::class);
    }

    public function Order(){
        return $this->hasMany(OrderProduct::class);
    }
}
