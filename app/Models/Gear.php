<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gear extends Model
{
    protected $fillable = [
        'category_id',
        'code',
        'name',
        'brand',
        'condition',
        'status',
        'location',
        'notes',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function loanItems()
    {
        return $this->hasMany(LoanItem::class);
    }
}
