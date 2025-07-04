<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GameType extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}