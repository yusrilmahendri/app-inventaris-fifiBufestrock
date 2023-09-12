<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consumer;
use App\Models\Product;

class Supplier extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function customer(){
        return $this->belongsTo(Consumer::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }

}
