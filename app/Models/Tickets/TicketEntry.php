<?php

namespace App\Models\Tickets;

use App\Models\User;
use Database\Factories\TicketEntryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class TicketEntry extends Model
{
    use LogsActivity,
        HasFactory,
        SoftDeletes;

    protected $perPage = 50;

    protected $fillable = [
        "title",
        "description",
        "ticket_entry_id",
        "ticket_category_id",
        "priority",
        "status",
        "reported_via",
    ];

    protected static function newFactory()
    {
        return TicketEntryFactory::new();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly([
            "title",
            "priority",
            "status",
            "description",
        ])->logOnlyDirty();
    }

    public function activity()
    {
        return $this->hasMany(Activity::class, 'subject_id');
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class, "ticket_category_id");
    }

    public function childTickets()
    {
        return $this
            ->hasMany(TicketEntry::class, "ticket_entry_id")
            ->select(["id", "title", "ticket_entry_id", "created_at", "status"])
            ->orderByRaw("FIELD(status, 'pending', 'new', 'in_progress', 'closed')");
    }

    public function parentTicket()
    {
        return $this->belongsTo(TicketEntry::class, "ticket_entry_id");
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'ticket_entries_users', 'ticket_entry_id', 'user_id');
    }

    public function getHeadcoachAttribute()
    {
        return $this->users()->wherePivot('is_headcoach', true)->first();
    }

    public function comments()
    {
        return $this->hasMany(TicketComment::class, 'ticket_entry_id');
    }

	public function getReportedViaAttribute($value)
	{
        return trans("ticket.reported_via_options.$value");
	}

    public function getTableRowClassAttribute()
    {
        if ($this->status == "pending") {
            return "table-warning";
        }

        if ($this->status == "closed") {
            return "table-success text-strikethrough";
        }

        return "";
    }

    public function getStatusFormattedAttribute()
    {
        return trans("ticket.statuses.$this->status");
    }

    public function getTitleFormattedAttribute()
    {
        return "#{$this->id} {$this->title}";
    }

    public function getCompletitionTimeAttribute()
    {

    }

    public function hasHighPriority()
    {
        return $this->priority === "high";
    }
}
