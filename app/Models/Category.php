<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'badge_color'];

    public function gears()
    {
        return $this->hasMany(Gear::class);
    }
}
