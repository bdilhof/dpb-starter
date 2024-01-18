<?php

namespace App\Models\Tickets;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TicketComment extends Model
{
    protected $fillable = [
        "text",
        "user_id",
    ];

    public function getHeadlineAttribute()
    {
        return "{$this->user->name}, {$this->created_at}";
    }

    public function ticket()
    {
        return $this->belongsTo(TicketEntry::class, 'ticket_entry_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
