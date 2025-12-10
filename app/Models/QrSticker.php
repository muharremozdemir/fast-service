<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class QrSticker extends Model
{
    protected $fillable = [
        'room_id',
        'uuid',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($qrSticker) {
            if (empty($qrSticker->uuid)) {
                $qrSticker->uuid = (string) Str::uuid();
            }
        });
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
