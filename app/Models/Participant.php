<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $primaryKey = 'participant_id';

    protected $fillable = [
        'event_id',
        'user_id',
        'invited_by_user_id',
        'status',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function invitedByUser()
    {
        return $this->belongsTo(User::class, 'invited_by_user_id');
    }

    public function scopeExistsForEventAndUser($query, $eventId, $userId)
    {
        return $query->where('event_id', $eventId)
                     ->where('user_id', $userId)
                     ->exists();
    }
}
