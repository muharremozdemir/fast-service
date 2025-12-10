<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'room_id',
        'room_number',
        'order_number',
        'status',
        'total',
        'notes',
        'closed_at',
        'company_id',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'closed_at' => 'datetime',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Check if order is closed
     */
    public function isClosed(): bool
    {
        return $this->closed_at !== null;
    }

    /**
     * Scope for open orders
     */
    public function scopeOpen($query)
    {
        return $query->whereNull('closed_at');
    }

    /**
     * Scope for closed orders
     */
    public function scopeClosed($query)
    {
        return $query->whereNotNull('closed_at');
    }

    /**
     * Generate unique order number
     */
    public static function generateOrderNumber(): string
    {
        do {
            $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
        } while (self::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }
}
