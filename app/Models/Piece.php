<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class piece extends Model
{
    use HasFactory;
    protected $table = 'piece';
    protected $fillable = [
        'PName',
        'PImage',
        'ShapeID',
        'ColorID',
        'SizeID',
        'InStock',
        'created_by'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
