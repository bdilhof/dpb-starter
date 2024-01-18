<?php

namespace App\Services\TicketService;

use App\Models\Tickets\TicketEntry;

class CreateTicketService
{
    public function createNewTicket($data)
    {
        $ticket = TicketEntry::make($data);

        if (! $ticket->save()) {
            dd("TODO: Handle error");
        }

        return $ticket;
    }
}