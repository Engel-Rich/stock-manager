<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected  $fillable = [
        'article_id',
        'amount',
        'quantite_article',
        'quantite_carton',
        'sense',
    ];
}
