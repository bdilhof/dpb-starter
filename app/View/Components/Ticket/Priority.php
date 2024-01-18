<?php

namespace App\View\Components\Ticket;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Priority extends Component
{   
    public $ticket;

    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    public function getClass()
    {
        $classes = [
            "low"    => "badge bg-success",
            "normal" => "badge bg-secondary",
            "high"   => "badge bg-danger",
        ];

        return $classes[$this->ticket->priority];
    }

    public function render()
    {
        return view('components.ticket.priority');
    }
}
