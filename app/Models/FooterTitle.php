<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterTitle extends Model
{
    use HasFactory;

    protected $fillable = [
        'footer_grid_one_title',
        'footer_grid_two_title'
    ];

}
