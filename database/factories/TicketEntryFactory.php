<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tickets\TicketEntry;

class TicketEntryFactory extends Factory
{
    protected $model = TicketEntry::class;

    public function definition()
    {
        return [
            "title" => fake()->text(50),
            "description" => fake()->text(255),
            "priority" => \Arr::random(config("dpb.priorities")),
            "status" => \Arr::random(config("dpb.statuses")),
            "reported_via" => \Arr::random(config("dpb.reported_via")),
            "created_at" => fake()->date("Y-m-d H:i:s"),
        ];
    }
}
