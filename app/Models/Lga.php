<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lga extends Model
{
    use HasFactory;

    public function state(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function pollingUnit(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PollingUnit::class, 'lga_id', 'lga_id');
    }
}
