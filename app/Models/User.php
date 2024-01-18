<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Tickets\TicketEntry;

class User extends Authenticatable
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->name);

        $initials = array_map(function ($word) {
            return str()->substr($word, 0, 1);
        }, $words);

        return strtoupper(implode('', $initials));
    }

    public function getNameFormattedAttribute()
    {
        return "$this->name ($this->login)";
    }

    public function tickets()
    {
        return $this->belongsToMany(TicketEntry::class, 'ticket_entries_users', 'user_id', 'ticket_entry_id');
    }
}
