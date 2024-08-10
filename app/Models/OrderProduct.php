<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;



    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
