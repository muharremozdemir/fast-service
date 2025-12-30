<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'floor_id',
        'room_number',
        'name',
        'description',
        'is_active',
        'sort_order',
        'user_id',
        'company_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'room_user')
            ->withPivot('category_id')
            ->withTimestamps();
    }

    public function usersByCategory($categoryId)
    {
        return $this->belongsToMany(User::class, 'room_user')
            ->wherePivot('category_id', $categoryId)
            ->withTimestamps();
    }

    public function qrSticker()
    {
        return $this->hasOne(QrSticker::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
