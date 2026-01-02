<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'symbol',
        'name',
        'exchange_rate',
        'is_active',
        'is_default',
        'decimal_places',
        'sort_order',
        'last_updated_at',
    ];

    protected $casts = [
        'exchange_rate' => 'decimal:4',
        'is_active' => 'boolean',
        'is_default' => 'boolean',
        'decimal_places' => 'integer',
        'sort_order' => 'integer',
        'last_updated_at' => 'datetime',
    ];

    /**
     * Aktif para birimlerini getir
     */
    public static function getActive()
    {
        return static::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    /**
     * Varsayılan para birimini getir
     */
    public static function getDefault()
    {
        return static::where('is_default', true)->first() 
            ?? static::where('code', 'TRY')->first();
    }

    /**
     * Para birimine göre fiyatı formatla
     */
    public function formatPrice($amount)
    {
        return number_format($amount, $this->decimal_places, ',', '.') . ' ' . $this->symbol;
    }

    /**
     * TRY'den bu para birimine dönüştür
     */
    public function convertFromTry($amount)
    {
        if ($this->code === 'TRY') {
            return $amount;
        }
        return $amount / $this->exchange_rate;
    }

    /**
     * Bu para biriminden TRY'ye dönüştür
     */
    public function convertToTry($amount)
    {
        if ($this->code === 'TRY') {
            return $amount;
        }
        return $amount * $this->exchange_rate;
    }
}
