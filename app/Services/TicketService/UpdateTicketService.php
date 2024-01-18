<?php

namespace App\Services\TicketService;

use App\Models\Tickets\TicketEntry;

class UpdateTicketService
{
    public function updateTicket($ticket, $data)
    {
        $ticketIsUpdated = $ticket->update($data);

        return $ticketIsUpdated;
    }
}