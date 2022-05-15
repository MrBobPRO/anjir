<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    // category_id = 0     => Home Page
    // category_id = -1    => Discounts Page
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
