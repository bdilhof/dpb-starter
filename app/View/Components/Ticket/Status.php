<?php

namespace App\View\Components\Ticket;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Status extends Component
{
    public $ticket;

    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    public function getClass()
    {
        $classes = [
            "new"         => "badge bg-secondary",
            "in_progress" => "badge bg-primary",
            "pending"     => "badge bg-warning",
            "closed"      => "badge bg-success",
        ];

        return $classes[$this->ticket->status];
    }

    public function render()
    {
        return view('components.ticket.status');
    }
}
