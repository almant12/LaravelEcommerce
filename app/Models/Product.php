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

    public function imageGalleries(){
    return $this->hasMany(ProductImageGallery::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
}
