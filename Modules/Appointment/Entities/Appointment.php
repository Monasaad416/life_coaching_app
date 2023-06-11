<?php

namespace Modules\Appointment\Entities;

use App\Models\Coach;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['day','from','to','coach_id'];
    
    protected static function newFactory()
    {
        return \Modules\Appointment\Database\factories\AppointmentFactory::new();
    }

    public function coach () {
        return $this->belongsTo(Coach::class);
    }
}
