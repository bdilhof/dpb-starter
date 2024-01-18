<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tickets\TicketEntry;
use App\Services\TicketService\CreateTicketService;

class TicketEntryController extends Controller
{
    public function index()
    {
        $tickets = TicketEntry::all();

        return $tickets;
    }

    public function store(Request $request, CreateTicketService $createTicketService)
    {
        $createTicketService->createNewTicket([
            "title" => $request->input("title"),
            "description" => $request->input("description"),
            "reported_via" => $request->input("reported_via"),
            "ticket_category_id" => $request->input("ticket_category_id"),
        ]);
    }

    public function show(string $id)
    {
        $ticket = TicketEntry::findOrFail($id);

        return $ticket;
    }
}
