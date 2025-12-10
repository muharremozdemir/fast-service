<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Block extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'block_code',
        'description',
        'is_active',
        'sort_order',
        'company_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function floors()
    {
        return $this->hasMany(Floor::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
