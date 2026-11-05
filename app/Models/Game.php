<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    public function guides(): HasMany
{
    return $this->hasMany(Guide::class);
}
}
