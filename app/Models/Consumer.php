<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Consumer extends Model
{
    use HasFactory;

    protected $guarded = [''];
    
    public function user(){
        return $this->belongsTo(User::class);
    }  

    public function supplier(){
        return $this->hasMany(Supplier::class);
    }
    public function product(){
        return $this->hasMany(Product::class);
    }
}
