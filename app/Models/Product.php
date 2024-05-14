<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title', 'category_id', 'description', 'price', 'discount'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
