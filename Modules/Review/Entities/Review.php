<?php

namespace Modules\Review\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Service\Entities\Service;
use App\Models\Coach;
use App\Models\Client;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['coach_id','client_id','service_id','rating','comment'];
    
    protected static function newFactory()
    {
        return \Modules\Review\Database\factories\ReviewFactory::new();
    }



    public function coach()
    {
        return $this->belongsTo(Coach::class,'coach_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id')->select('id','name_'.LaravelLocalization::getCurrentLocale().' as name');
    }
}
