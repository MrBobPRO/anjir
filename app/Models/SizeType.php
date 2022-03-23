<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeType extends Model
{
    use HasFactory;

    public function sizes()
    {
        return $this->hasMany(Size::class, 'type_id');
    }
}
