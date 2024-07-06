<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $primaryKey = 'event_id';

    protected $fillable = [
        'name',
        'date',
        'location',
        'image_url',
        'type',
        'visibility',
        'description',
        'creator_id',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    

    public function participants()
    {
        return $this->hasMany(Participant::class,'event_id');
    }
}
