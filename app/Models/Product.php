<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str; 

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'image',
        'is_active',
        'company_id',
        'type',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the image URL attribute.
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('site/assets/img/product-img-1.jpg');
    }

    /**
     * Get the short description attribute.
     */
    public function getShortDescriptionAttribute()
    {
        if ($this->description) {
            return Str::limit($this->description, 100);
        }
        return '';
    }

    /**
     * Get the converted price (TRY'den seçili para birimine dönüştürülmüş)
     */
    public function getConvertedPriceAttribute()
    {
        return convertPrice($this->price, 'TRY');
    }

    /**
     * Get the formatted price (para birimi sembolü ile)
     */
    public function getFormattedPriceAttribute()
    {
        return formatPrice($this->converted_price);
    }

    /**
     * Get the raw price in TRY (admin için)
     */
    public function getRawPriceAttribute()
    {
        return $this->price;
    }
}
