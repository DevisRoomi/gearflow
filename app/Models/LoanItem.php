<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanItem extends Model
{
    protected $fillable = [
        'loan_id',
        'gear_id',
        'condition_before',
        'condition_after',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function gear()
    {
        return $this->belongsTo(Gear::class);
    }
}
