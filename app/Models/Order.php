<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Customer(){
        return $this->belongsTo(User::class);
    }

    public function Processor(){
        return $this->hasOne(User::class,'processed_by');
    }
}
