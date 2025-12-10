<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Floor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'floor_number',
        'description',
        'is_active',
        'sort_order',
        'user_id',
        'block_id',
        'company_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'floor_number' => 'integer',
        'sort_order' => 'integer',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
