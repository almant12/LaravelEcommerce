<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function productVariants(){
        return $this->hasMany(ProductVariant::class);
    }

    public function imagesGallery(){
    return $this->hasMany(ProductImageGallery::class);
    }
}
