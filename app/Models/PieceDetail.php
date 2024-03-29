<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Nullable;

class PieceDetail extends Model
{
    use HasFactory;
    protected $table = 'piecedetail';

    protected $fillable = [
        'ProductID',
        'PieceID',
        'StockUse',
    ];
}
