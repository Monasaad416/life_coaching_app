<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar','name_en','parent_id','slug'];

    protected static function newFactory()
    {
        return \Modules\Category\Database\factories\CategoryFactory::new();
    }


       public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','parent_id');
    }


    
    public function services() {
        $this->hasMany(Service::class);
    }
}
