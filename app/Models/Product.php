<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consumer;
use App\Models\Supplier;
use App\Models\BufferStock;
use App\Models\InventoryMoment;
use App\Models\LeadTime;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [''];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function consumer()
    {
        return $this->belongsTo(Consumer::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function inventoryMoment(){
        return $this->hasMany(InventoryMoment::class);
    }

    public function bufferStock(){
        return $this->hasMany(BufferStock::class);
    }

    public function leadTime(){
        return $this->hasMany(LeadTime::class);
    }
}
