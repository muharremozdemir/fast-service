<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'tax_number',
        'tax_office',
        'is_active',
        'license_expires_at',
        'logo_path',
        'logo_type',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'license_expires_at' => 'date',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }

    public function floors()
    {
        return $this->hasMany(Floor::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    /**
     * Lisansın kalan gün sayısını döndürür
     */
    public function getDaysRemainingAttribute()
    {
        if (!$this->license_expires_at) {
            return null;
        }
        
        $now = now();
        $expiresAt = $this->license_expires_at;
        
        $days = $now->diffInDays($expiresAt, false);
        return max(0, (int) floor($days));
    }

    /**
     * Lisansın son 15 gün içinde bitip bitmediğini kontrol eder
     */
    public function isLicenseExpiringSoon()
    {
        if (!$this->license_expires_at) {
            return false;
        }
        
        $daysRemaining = $this->days_remaining;
        return $daysRemaining !== null && $daysRemaining <= 15 && $daysRemaining >= 0;
    }

    /**
     * Lisansın süresi dolmuş mu kontrol eder
     */
    public function isLicenseExpired()
    {
        if (!$this->license_expires_at) {
            return false;
        }
        
        return $this->days_remaining === 0;
    }

    /**
     * Logo URL'ini döndürür
     */
    public function getLogoUrlAttribute()
    {
        if ($this->logo_type === 'company' && $this->logo_path) {
            return asset('storage/' . $this->logo_path);
        }
        
        // Fast Service logosu
        return asset('site/assets/img/logo.png');
    }
}
