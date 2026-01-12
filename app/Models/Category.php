<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;
    // use SoftDeletes isteğe bağlı;

    protected $fillable = [
        'parent_id','name','slug','image_path','sort_order','is_active','description','company_id'
    ];

    public $translatable = ['name', 'description'];

    public function parent(){ return $this->belongsTo(Category::class, 'parent_id'); }
    public function children(){ return $this->hasMany(Category::class, 'parent_id'); }
    public function products(){ return $this->hasMany(Product::class); }
    public function users(){ return $this->belongsToMany(User::class, 'category_user'); }
    public function company(){ return $this->belongsTo(Company::class); }
    
}