<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function notifiedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'order_item_user')
            ->withTimestamps();
    }

    /**
     * Get status label in Turkish
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Talep Alındı',
            'in_progress' => 'Talep Karşılanıyor',
            'completed' => 'Tamamlandı',
            default => 'Bilinmeyen',
        };
    }
}
