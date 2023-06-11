<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\Review;
use App\Models\Coach;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Service extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    protected static function newFactory()
    {
        return \Modules\Service\Database\factories\ServiceFactory::new();
    }


  
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->select('id','name_'.LaravelLocalization::getCurrentLocale().' as name');
    }

    public function coach () {
        return $this->belongsTo(Coach::class);
    }


    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
