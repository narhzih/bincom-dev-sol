<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollingUnit extends Model
{
    use HasFactory;

    public function announcedPuResult(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AnnouncedPuResult::class);
    }

    public function ward(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function lga(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Lga::class, 'lga_id', 'lga_id');
    }

    public function state(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(State::class);
    }

}
