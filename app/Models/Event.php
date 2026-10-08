<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    use HasFactory;
    
    protected $table = 'events';
    protected $primaryKey = 'event_id';
    protected $fillable = ['event_type', 'event_name', 'start_date', 'end_date'];
    public function examinations()
    {
        return $this->hasMany(Examination::class, 'event_id', 'event_id'); 
    }
}

