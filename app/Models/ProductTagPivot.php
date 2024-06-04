<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTagPivot extends Model
{
    use HasFactory;

    protected $table = 'product_tag';

    protected $fillable = [
        'product_id',
        'product_tag_id',
    ];
}
