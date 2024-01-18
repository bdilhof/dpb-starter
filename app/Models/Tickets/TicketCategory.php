<?php

namespace App\Models\Tickets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\TicketEntryFactory;

class TicketCategory extends Model
{
    protected $fillable = [
        "title",
        "ticket_category_id",
    ];

    public function parentCategory()
    {
        return $this->belongsTo(TicketCategory::class, 'ticket_category_id');
    }

    public function subCategories()
    {
        return $this->hasMany(TicketCategory::class, 'ticket_category_id');
    }

    public function tickets()
    {
        return $this->hasMany(TicketEntry::class, 'ticket_entry_id');
    }

    public static function categoryTree()
    {
        $cacheKey = 'ticketCategoryTree';

        return \Cache::remember($cacheKey, 60, function () {
            return self::query()
                ->select("id", "title")
                ->with("subCategories:id,title,ticket_category_id")
                ->whereNull("ticket_category_id")
                ->get();
        });
    }
}
